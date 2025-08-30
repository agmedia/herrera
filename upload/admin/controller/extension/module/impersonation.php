<?php

class ControllerExtensionModuleImpersonation extends Controller
{
    public function index() {
        $this->load->language('extension/module/agm_api');

        $this->document->setTitle($this->language->get('heading_title'));

        // No UI. Just redirect back to Extensions list.
        $token = isset($this->session->data['user_token'])
            ? 'user_token=' . $this->session->data['user_token']
            : 'token=' . $this->session->data['token'];
        $this->response->redirect($this->url->link('marketplace/extension', $token . '&type=module', true));
    }

    public function install() {
        // 1) tables
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "impersonation_session` (
              `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
              `session_id` VARCHAR(128) NOT NULL,
              `admin_id` BIGINT UNSIGNED NOT NULL,
              `customer_id` BIGINT UNSIGNED NOT NULL,
              `store_id` INT UNSIGNED NULL,
              `store_host` VARCHAR(191) NOT NULL,
              `admin_from_url` VARCHAR(255) NULL,
              `ip` VARBINARY(16) NULL,
              `user_agent` VARCHAR(1024) NULL,
              `started_at` DATETIME NOT NULL,
              `last_activity_at` DATETIME NOT NULL,
              `ended_at` DATETIME NULL,
              `duration_seconds` INT NULL,
              `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              KEY `sess_open` (`session_id`,`ended_at`),
              KEY `by_admin_start` (`admin_id`,`started_at`),
              KEY `by_customer_start` (`customer_id`,`started_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "impersonation_event` (
              `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
              `impersonation_session_id` BIGINT UNSIGNED NOT NULL,
              `occurred_at` DATETIME NOT NULL,
              `method` VARCHAR(8) NOT NULL,
              `route` VARCHAR(191) NULL,
              `entity_type` ENUM('product','category','manufacturer','information','search','cart','checkout','page') NULL,
              `entity_id` BIGINT UNSIGNED NULL,
              `path` VARCHAR(255) NOT NULL,
              `status` SMALLINT UNSIGNED NOT NULL DEFAULT 200,
              `referrer` VARCHAR(255) NULL,
              `query` JSON NULL,
              `meta`  JSON NULL,
              `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              KEY `by_session_time` (`impersonation_session_id`,`occurred_at`),
              KEY `idx_ie_entity` (`entity_type`,`entity_id`,`occurred_at`),
              CONSTRAINT `fk_impersonation_session` FOREIGN KEY (`impersonation_session_id`)
                REFERENCES `" . DB_PREFIX . "impersonation_session`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        // 2) default secret (only if missing) — stored as a regular setting, no UI.
        $this->load->model('setting/setting');
        if (!$this->config->get('module_impersonation_secret')) {
            $secret = bin2hex(random_bytes(16));
            $this->model_setting_setting->editSetting('module_impersonation', [
                'module_impersonation_secret' => $secret
            ]);
        }

        // 3) event hook (catalog side) -> calls controller/extension/module/impersonation::before
        $this->load->model('setting/event');
        $this->model_setting_event->deleteEventByCode('impersonation_before');
        // params: code, trigger, action, status(1=enabled), sort_order
        $this->model_setting_event->addEvent(
            'impersonation_before',
            'catalog/controller/*/before',
            'extension/module/impersonation/before',
            1,
            0
        );
    }

    public function uninstall() {
        // keep tables for audit; just remove the event
        $this->load->model('setting/event');
        $this->model_setting_event->deleteEventByCode('impersonation_before');
    }

    // admin/controller/extension/module/impersonation.php (snippet)
    public function link() {
        $this->load->model('setting/setting');

        // secret configured at module settings (create a setting: module_impersonation_secret)
        $secret = $this->config->get('module_impersonation_secret') ?: 'change-me';

        $admin_id    = (int)$this->session->data['user_id'];
        $customer_id = (int)$this->request->get['customer_id'];
        $store_id    = (int)($this->request->get['store_id'] ?? 0);
        $from_url    = $this->url->link('customer/customer/edit', 'user_token=' . $this->session->data['user_token'] . '&customer_id=' . $customer_id, true);

        $payload = [
            'admin_id'    => $admin_id,
            'customer_id' => $customer_id,
            'store_id'    => $store_id,
            'from_url'    => $from_url,
            'exp'         => time() + 600, // 10 min
        ];
        $b64 = rtrim(strtr(base64_encode(json_encode($payload)), '+/', '-_'), '=');
        $sig = rtrim(strtr(base64_encode(hash_hmac('sha256', $b64, $secret, true)), '+/', '-_'), '=');
        $token = $b64 . '.' . $sig;

        // Choose store URL (by store_id) as needed
        $front = $this->config->get('config_url'); // or lookup in setting/store table
        $link  = $front . 'index.php?route=extension/module/impersonation/start&token=' . $token;

        $this->response->setOutput($link);
    }


    /**
     * All products clicked by admin X while
     * impersonating customer Y (most recent first):
     *
     * @return mixed
     */
    public function products()
    {
        $query = $this->db->query(
            "SELECT e.occurred_at, e.entity_id AS product_id, JSON_UNQUOTE(JSON_EXTRACT(e.meta,'$.href')) AS href
                                        FROM oc_impersonation_event e
                                        JOIN oc_impersonation_session s ON s.id = e.impersonation_session_id
                                        WHERE s.admin_id = :admin_id
                                          AND s.customer_id = :customer_id
                                          AND e.entity_type = 'product'
                                        ORDER BY e.occurred_at DESC"
        );

        return $query;
    }


    /**
     * Top categories touched in a session:
     *
     * @return mixed
     */
    public function categories()
    {
        $query = $this->db->query(
            "SELECT e.entity_id AS category_id, COUNT(*) AS clicks
                    FROM oc_impersonation_event e
                    WHERE e.impersonation_session_id = :session_id
                      AND e.entity_type = 'category'
                    GROUP BY e.entity_id
                    ORDER BY clicks DESC"
        );

        return $query;
    }


    /**
     * Full timeline for one impersonation:
     *
     * @return mixed
     */
    public function sessionTimeline()
    {
        $query = $this->db->query(
            "SELECT occurred_at, method, route, entity_type, entity_id, path, status
                    FROM oc_impersonation_event
                    WHERE impersonation_session_id = :session_id
                    ORDER BY occurred_at ASC"
        );

        return $query;
    }

}

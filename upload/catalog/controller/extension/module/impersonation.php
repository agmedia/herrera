<?php
class ControllerExtensionModuleImpersonation extends Controller
{
    private array $ignore = [
        'common/maintenance','common/language/language',
        'extension/module/impersonation/start',
        'extension/module/impersonation/stop',
        'extension/module/impersonation/beacon'
    ];

    // GET /index.php?route=extension/module/impersonation/start&token=...
    public function start() {
        $secret = $this->config->get('module_impersonation_secret') ?: 'change-me';
        $token  = $this->request->get['token'] ?? '';

        if (!$token || strpos($token, '.') === false) {
            $this->response->redirect($this->url->link('common/home'));
            return;
        }

        [$b64, $sig] = explode('.', $token, 2);
        $expect = rtrim(strtr(base64_encode(hash_hmac('sha256', $b64, $secret, true)), '+/', '-_'), '=');
        if (!hash_equals($expect, $sig)) {
            $this->response->redirect($this->url->link('common/home'));
            return;
        }

        $data = json_decode(base64_decode(strtr($b64, '-_', '+/')), true);
        if (!$data || (time() > (int)$data['exp'])) {
            $this->response->redirect($this->url->link('common/home'));
            return;
        }

        // Set marker
        $this->session->data['order_from_manager'] = [
            'admin_id'    => (int)$data['admin_id'],
            'customer_id' => (int)$data['customer_id'],
            'store_id'    => (int)$data['store_id'],
            'from_url'    => (string)$data['from_url'],
            'started_at'  => time(),
        ];

        // Ensure session row exists
        $this->ensureSessionRow();

        // Redirect to homepage (or customer account)
        $this->response->redirect($this->url->link('common/home'));
    }

    // GET /index.php?route=extension/module/impersonation/stop
    public function stop() {
        if (!empty($this->session->data['order_from_manager'])) {
            $this->closeSessionRow();
            unset($this->session->data['order_from_manager']);
        }
        $this->response->redirect($this->url->link('common/home'));
    }

    // Event: controller/*/before
    public function before(&$route, &$args) {
        if (empty($this->session->data['order_from_manager'])) return;
        if (in_array($route, $this->ignore, true)) return;

        // skip asset-like paths
        $path = ltrim($this->request->server['REQUEST_URI'] ?? '', '/');
        if ($this->isStatic($path)) return;

        $sess_id = $this->ensureSessionRow();

        [$etype, $eid, $extraMeta] = $this->classify($route, $this->request->get);

        if ($etype == 'page') return;

        // record event minimally
        $this->db->query("INSERT INTO `" . DB_PREFIX . "impersonation_event`
              SET impersonation_session_id = " . (int)$sess_id . ",
                  occurred_at = NOW(),
                  method = '" . $this->db->escape($this->request->server['REQUEST_METHOD'] ?? 'GET') . "',
                  route  = '" . $this->db->escape($route) . "',
                  entity_type = " . ($etype ? "'" . $this->db->escape($etype) . "'" : "NULL") . ",
                  entity_id   = " . ($eid ? (int)$eid : "NULL") . ",
                  path   = '" . $this->db->escape('/' . $path) . "',
                  status = 200,
                  referrer = " . $this->toVarchar($this->request->server['HTTP_REFERER'] ?? null, 255) . ",
                  query = " . $this->toJson($this->request->get) . ",
                  meta  = " . $this->toJson($extraMeta) . ",
                  created_at = NOW()");

        // touch last activity
        $this->db->query("UPDATE `" . DB_PREFIX . "impersonation_session`
            SET last_activity_at = NOW(), updated_at = NOW()
            WHERE id = " . (int)$sess_id . " LIMIT 1");
    }


    /**
     * You can add data-entity-type="product" data-entity-id="{{ product_id }}"
     * on the <a> to guarantee perfect attribution
     * (the beacon will use those over inference).
     *
     * @return void
     */
    public function beacon() {
        if (empty($this->session->data['order_from_manager'])) {
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode(['ok'=>true]));
            return;
        }
        $sess_id = $this->ensureSessionRow();
        $json = json_decode(file_get_contents('php://input'), true) ?: [];
        $action = (string)($json['action'] ?? 'client_action');
        $etype  = $json['entity_type'] ?? null;
        $eid    = isset($json['entity_id']) ? (int)$json['entity_id'] : null;
        $meta   = $json['meta'] ?? [];
        if (!empty($json['href']))  $meta['href'] = $json['href'];
        if (!empty($json['text']))  $meta['text'] = $json['text'];

        $this->db->query("INSERT INTO `" . DB_PREFIX . "impersonation_event`
        SET impersonation_session_id = " . (int)$sess_id . ",
            occurred_at = NOW(),
            method = 'POST',
            route  = 'extension/module/impersonation/beacon',
            entity_type = " . ($etype ? "'" . $this->db->escape($etype) . "'" : "NULL") . ",
            entity_id   = " . ($eid ?: "NULL") . ",
            path   = '/impersonation/beacon',
            status = 200,
            referrer = " . $this->toVarchar($this->request->server['HTTP_REFERER'] ?? null, 255) . ",
            query = NULL,
            meta  = " . $this->toJson($meta) . ",
            created_at = NOW()");

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode(['ok'=>true]));
    }

    // Helpers
    private function isStatic(string $path): bool {
        foreach (['catalog/view/', 'image/', 'storage/', 'system/', 'admin/', 'extension/module/impersonation'] as $p) {
            if (str_starts_with($path, $p)) return true;
        }
        return false;
    }

    private function classify(string $route, array $q): array
    {
        $etype = null; $eid = null; $meta = [];

        // Product detail
        if ($route === 'product/product' && !empty($q['product_id'])) {
            $etype = 'product'; $eid = (int)$q['product_id'];
        }
        // Category listing (path like 20_27 -> use last id)
        elseif ($route === 'product/category' && !empty($q['path'])) {
            $etype = 'category';
            $parts = array_filter(explode('_', (string)$q['path']));
            $eid = (int) end($parts);
            $meta['category_path'] = (string) $q['path'];
        }
        // Manufacturer
        elseif (in_array($route, ['product/manufacturer', 'product/manufacturer/info'], true) && !empty($q['manufacturer_id'])) {
            $etype = 'manufacturer'; $eid = (int)$q['manufacturer_id'];
        }
        // Information pages
        elseif ($route === 'information/information' && !empty($q['information_id'])) {
            $etype = 'information'; $eid = (int)$q['information_id'];
        }
        // Search
        elseif ($route === 'product/search' && (!empty($q['search']) || !empty($q['filter_name']))) {
            $etype = 'search'; $eid = null;
            $meta['search'] = $q['search'] ?? $q['filter_name'] ?? '';
        }
        // Cart & checkout
        elseif ($route === 'checkout/cart') {
            $etype = 'cart';
        }
        elseif (strpos($route, 'checkout/') === 0) {
            $etype = 'checkout';
        }
        // Fallback: regular page
        else {
            $etype = 'page';
        }

        return [$etype, $eid, $meta];
    }


    private function ensureSessionRow(): int {
        $mark      = $this->session->data['order_from_manager'];
        $sid       = session_id();
        $adminId   = (int)$mark['admin_id'];
        $customerId= (int)$mark['customer_id'];
        $storeId   = (int)($mark['store_id'] ?? 0);

        // 1) Try to find an open row for THIS (session_id, admin, customer, store)
        $q = $this->db->query("SELECT id FROM `" . DB_PREFIX . "impersonation_session`
                                WHERE session_id = '" . $this->db->escape($sid) . "'
                                  AND admin_id = " . $adminId . "
                                  AND customer_id = " . $customerId . "
                                  AND store_id = " . $storeId . "
                                  AND ended_at IS NULL
                                ORDER BY id DESC LIMIT 1");

        if ($q->num_rows) {
            return (int)$q->row['id'];
        }

        // 2) Close any other open rows on this PHP session (previous customer, etc.)
        $this->db->query("UPDATE `" . DB_PREFIX . "impersonation_session`
                                SET ended_at = NOW(),
                                    duration_seconds = TIMESTAMPDIFF(SECOND, started_at, NOW()),
                                    updated_at = NOW()
                                WHERE session_id = '" . $this->db->escape($sid) . "'
                                  AND ended_at IS NULL");

        // 3) Insert a fresh row for this customer
        $ip = isset($this->request->server['REMOTE_ADDR']) ? @inet_pton($this->request->server['REMOTE_ADDR']) : null;
        $ua = isset($this->request->server['HTTP_USER_AGENT']) ? substr($this->request->server['HTTP_USER_AGENT'], 0, 1024) : '';

        $this->db->query("INSERT INTO `" . DB_PREFIX . "impersonation_session`
                            SET session_id = '" . $this->db->escape($sid) . "',
                                admin_id = " . $adminId . ",
                                customer_id = " . $customerId . ",
                                store_id = " . $storeId . ",
                                store_host = '" . $this->db->escape($this->request->server['HTTP_HOST'] ?? '') . "',
                                admin_from_url = " . $this->toVarchar($mark['from_url'] ?? null, 255) . ",
                                ip = " . ($ip ? "UNHEX('" . bin2hex($ip) . "')" : "NULL") . ",
                                user_agent = " . $this->toVarchar($ua, 1024) . ",
                                started_at = NOW(),
                                last_activity_at = NOW(),
                                created_at = NOW(), updated_at = NOW()");

        return (int)$this->db->getLastId();
    }
    private function closeSessionRow(): void {
        $sid = session_id();
        $this->db->query("UPDATE `" . DB_PREFIX . "impersonation_session`
            SET ended_at = NOW(),
                duration_seconds = TIMESTAMPDIFF(SECOND, started_at, NOW()),
                updated_at = NOW()
            WHERE session_id = '" . $this->db->escape($sid) . "'
              AND ended_at IS NULL");
    }
    private function toVarchar(?string $v, int $len): string {
        return $v ? "'" . $this->db->escape(substr($v, 0, $len)) . "'" : "NULL";
    }
    private function toJson(array $data): string {
        foreach (['password','token','_token','_method'] as $k) unset($data[$k]);
        if (!$data) return "NULL";
        return "'" . $this->db->escape(json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)) . "'";
    }

    public function cronClose() {
        $minutes = 30;
        $this->db->query("UPDATE `" . DB_PREFIX . "impersonation_session`
        SET ended_at = NOW(),
            duration_seconds = TIMESTAMPDIFF(SECOND, started_at, NOW()),
            updated_at = NOW()
        WHERE ended_at IS NULL
          AND last_activity_at < (NOW() - INTERVAL " . (int)$minutes . " MINUTE)");
        $this->response->setOutput('ok');
    }
}

<?php
class ModelExtensionModuleLegalReturn extends Model {
	private $schema_ready = false;

	public function ensureSchema() {
		if ($this->schema_ready) {
			return;
		}

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "legal_return_request` (
			`legal_return_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			`store_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
			`order_id` INT(11) UNSIGNED NOT NULL,
			`request_type` VARCHAR(32) NOT NULL,
			`firstname` VARCHAR(64) NOT NULL,
			`lastname` VARCHAR(64) NOT NULL,
			`email` VARCHAR(96) NOT NULL,
			`telephone` VARCHAR(32) NOT NULL DEFAULT '',
			`address` TEXT NOT NULL,
			`received_date` DATE DEFAULT NULL,
			`product_details` TEXT NOT NULL,
			`reason` TEXT NOT NULL,
			`iban` VARCHAR(64) NOT NULL DEFAULT '',
			`status` VARCHAR(32) NOT NULL DEFAULT 'new',
			`admin_note` TEXT NOT NULL,
			`ip` VARCHAR(45) NOT NULL DEFAULT '',
			`date_added` DATETIME NOT NULL,
			`date_modified` DATETIME NOT NULL,
			PRIMARY KEY (`legal_return_id`),
			KEY `order_date` (`order_id`, `date_added`),
			KEY `email` (`email`),
			KEY `ip_date` (`ip`, `date_added`),
			KEY `status_date` (`status`, `date_added`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "legal_return_attempt` (
			`rate_key` CHAR(64) NOT NULL,
			`window_started` DATETIME NOT NULL,
			`attempts` SMALLINT UNSIGNED NOT NULL DEFAULT '0',
			`date_modified` DATETIME NOT NULL,
			PRIMARY KEY (`rate_key`),
			KEY `date_modified` (`date_modified`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

		$this->ensureIndex(DB_PREFIX . 'legal_return_request', 'order_date', '`order_id`, `date_added`');
		$this->ensureIndex(DB_PREFIX . 'legal_return_request', 'ip_date', '`ip`, `date_added`');
		$this->schema_ready = true;
	}

	public function consumeVerificationAttempt($ip) {
		$this->ensureSchema();
		$ip = trim((string)$ip);

		if ($ip === '') {
			return false;
		}

		$key_secret = (string)$this->config->get('config_encryption');
		$rate_key = hash_hmac('sha256', $ip, $key_secret !== '' ? $key_secret : 'legal-return');
		$this->db->query("INSERT INTO `" . DB_PREFIX . "legal_return_attempt` SET
			`rate_key` = '" . $this->db->escape($rate_key) . "',
			`window_started` = NOW(),
			`attempts` = '1',
			`date_modified` = NOW()
			ON DUPLICATE KEY UPDATE
			`attempts` = IF(`window_started` < DATE_SUB(NOW(), INTERVAL 1 HOUR), 1, LEAST(`attempts` + 1, 65535)),
			`window_started` = IF(`window_started` < DATE_SUB(NOW(), INTERVAL 1 HOUR), NOW(), `window_started`),
			`date_modified` = NOW()");

		$query = $this->db->query("SELECT `attempts` FROM `" . DB_PREFIX . "legal_return_attempt` WHERE `rate_key` = '" . $this->db->escape($rate_key) . "' LIMIT 1");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "legal_return_attempt` WHERE `date_modified` < DATE_SUB(NOW(), INTERVAL 2 DAY) LIMIT 100");

		return $query->num_rows && (int)$query->row['attempts'] <= 20;
	}

	public function orderMatches($order_id, $email) {
		$order_id = (int)$order_id;
		$email = trim((string)$email);

		if ($order_id < 1 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return false;
		}

		$query = $this->db->query("SELECT `order_id` FROM `" . DB_PREFIX . "order` WHERE `order_id` = '" . $order_id . "' AND `store_id` = '" . (int)$this->config->get('config_store_id') . "' AND LCASE(`email`) = LCASE('" . $this->db->escape($email) . "') LIMIT 1");

		return (bool)$query->num_rows;
	}

	private function canSubmit($order_id, $ip) {
		$order_id = (int)$order_id;
		$ip = trim((string)$ip);
		$order_query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "legal_return_request` WHERE `order_id` = '" . $order_id . "' AND `date_added` >= DATE_SUB(NOW(), INTERVAL 1 DAY)");

		if ((int)$order_query->row['total'] >= 3) {
			return false;
		}

		if ($ip !== '') {
			$ip_query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "legal_return_request` WHERE `ip` = '" . $this->db->escape($ip) . "' AND `date_added` >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");

			if ((int)$ip_query->row['total'] >= 5) {
				return false;
			}
		}

		return true;
	}

	public function addRequest($data) {
		$this->ensureSchema();
		$lock_name = 'legal_return_' . substr(hash('sha256', DB_DATABASE . ':' . DB_PREFIX), 0, 32);
		$lock_query = $this->db->query("SELECT GET_LOCK('" . $this->db->escape($lock_name) . "', 5) AS acquired");

		if (!$lock_query->num_rows || (int)$lock_query->row['acquired'] !== 1) {
			return false;
		}

		try {
			if (!$this->canSubmit($data['order_id'], $data['ip'])) {
				return false;
			}

			$received_date = !empty($data['received_date']) ? "'" . $this->db->escape($data['received_date']) . "'" : 'NULL';

			$this->db->query("INSERT INTO `" . DB_PREFIX . "legal_return_request` SET
			store_id = '" . (int)$this->config->get('config_store_id') . "',
			order_id = '" . (int)$data['order_id'] . "',
			request_type = '" . $this->db->escape($data['request_type']) . "',
			firstname = '" . $this->db->escape($data['firstname']) . "',
			lastname = '" . $this->db->escape($data['lastname']) . "',
			email = '" . $this->db->escape($data['email']) . "',
			telephone = '" . $this->db->escape($data['telephone']) . "',
			address = '" . $this->db->escape($data['address']) . "',
			received_date = " . $received_date . ",
			product_details = '" . $this->db->escape($data['product_details']) . "',
			reason = '" . $this->db->escape($data['reason']) . "',
			iban = '" . $this->db->escape($data['iban']) . "',
			status = 'new',
			admin_note = '',
			ip = '" . $this->db->escape($data['ip']) . "',
			date_added = '" . $this->db->escape($data['submitted_at']) . "',
			date_modified = '" . $this->db->escape($data['submitted_at']) . "'");

			return $this->db->getLastId();
		} finally {
			$this->db->query("SELECT RELEASE_LOCK('" . $this->db->escape($lock_name) . "')");
		}
	}

	private function ensureIndex($table, $index, $columns) {
		$query = $this->db->query("SHOW INDEX FROM `" . $table . "` WHERE `Key_name` = '" . $this->db->escape($index) . "'");

		if (!$query->num_rows) {
			$this->db->query("ALTER TABLE `" . $table . "` ADD KEY `" . $index . "` (" . $columns . ")");
		}
	}
}

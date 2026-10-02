<?php
class ModelExtensionModuleLegalReturn extends Model {
	private $schema_ready = false;

	public function install() {
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

		$this->schema_ready = true;
	}

	public function getRequest($legal_return_id) {
		$this->install();
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "legal_return_request` WHERE legal_return_id = '" . (int)$legal_return_id . "'");
		return $query->row;
	}

	public function getRequests($data = array()) {
		$this->install();
		$sql = "SELECT * FROM `" . DB_PREFIX . "legal_return_request` WHERE 1";

		if (!empty($data['filter_status'])) {
			$sql .= " AND status = '" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['filter_search'])) {
			$search = $this->db->escape($data['filter_search']);
			$sql .= " AND (CAST(legal_return_id AS CHAR) LIKE '%" . $search . "%' OR CAST(order_id AS CHAR) LIKE '%" . $search . "%' OR firstname LIKE '%" . $search . "%' OR lastname LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%')";
		}

		$sort_data = array('legal_return_id', 'order_id', 'firstname', 'email', 'request_type', 'status', 'date_added');
		$sort = isset($data['sort']) && in_array($data['sort'], $sort_data) ? $data['sort'] : 'date_added';
		$order = isset($data['order']) && $data['order'] === 'ASC' ? 'ASC' : 'DESC';
		$sql .= " ORDER BY `" . $sort . "` " . $order;

		if (isset($data['start']) || isset($data['limit'])) {
			$start = max(0, (int)$data['start']);
			$limit = max(1, (int)$data['limit']);
			$sql .= " LIMIT " . $start . "," . $limit;
		}

		return $this->db->query($sql)->rows;
	}

	public function getTotalRequests($data = array()) {
		$this->install();
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "legal_return_request` WHERE 1";

		if (!empty($data['filter_status'])) {
			$sql .= " AND status = '" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['filter_search'])) {
			$search = $this->db->escape($data['filter_search']);
			$sql .= " AND (CAST(legal_return_id AS CHAR) LIKE '%" . $search . "%' OR CAST(order_id AS CHAR) LIKE '%" . $search . "%' OR firstname LIKE '%" . $search . "%' OR lastname LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%')";
		}

		$query = $this->db->query($sql);
		return (int)$query->row['total'];
	}

	public function getRequestsForExport($data = array(), $before_id = 0, $limit = 500) {
		$this->install();
		$limit = max(1, min(1000, (int)$limit));
		$sql = "SELECT * FROM `" . DB_PREFIX . "legal_return_request` WHERE 1";

		if (!empty($data['filter_status'])) {
			$sql .= " AND status = '" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['filter_search'])) {
			$search = $this->db->escape($data['filter_search']);
			$sql .= " AND (CAST(legal_return_id AS CHAR) LIKE '%" . $search . "%' OR CAST(order_id AS CHAR) LIKE '%" . $search . "%' OR firstname LIKE '%" . $search . "%' OR lastname LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%')";
		}

		if ((int)$before_id > 0) {
			$sql .= " AND legal_return_id < '" . (int)$before_id . "'";
		}

		$sql .= " ORDER BY legal_return_id DESC LIMIT " . $limit;

		return $this->db->query($sql)->rows;
	}

	public function updateRequest($legal_return_id, $status, $admin_note) {
		$this->db->query("UPDATE `" . DB_PREFIX . "legal_return_request` SET status = '" . $this->db->escape($status) . "', admin_note = '" . $this->db->escape($admin_note) . "', date_modified = NOW() WHERE legal_return_id = '" . (int)$legal_return_id . "'");
	}
}

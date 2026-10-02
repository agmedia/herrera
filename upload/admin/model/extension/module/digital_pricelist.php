<?php
class ModelExtensionModuleDigitalPricelist extends Model {
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "digital_pricelist_run` (
			`digital_pricelist_run_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`generated_at` DATETIME NOT NULL,
			`product_count` INT UNSIGNED NOT NULL DEFAULT '0',
			`duration_ms` INT UNSIGNED NOT NULL DEFAULT '0',
			`status` VARCHAR(16) NOT NULL,
			`message` VARCHAR(1000) NOT NULL DEFAULT '',
			PRIMARY KEY (`digital_pricelist_run_id`),
			KEY `generated_at` (`generated_at`),
			KEY `status` (`status`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "digital_pricelist_archive` (
			`digital_pricelist_archive_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`archive_number` INT UNSIGNED NOT NULL,
			`archived_at` DATETIME NOT NULL,
			`source_generated_at` DATETIME NOT NULL,
			`base_filename` VARCHAR(255) NOT NULL,
			PRIMARY KEY (`digital_pricelist_archive_id`),
			UNIQUE KEY `archive_number` (`archive_number`),
			UNIQUE KEY `base_filename` (`base_filename`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8");

		$this->load->model('setting/setting');
		$settings = $this->model_setting_setting->getSetting('module_digital_pricelist');
		$language_id = (int)$this->config->get('config_language_id');
		$language_code = (string)$this->config->get('config_language');

		if ($language_code !== '') {
			$language_query = $this->db->query("SELECT language_id FROM `" . DB_PREFIX . "language` WHERE code = '" . $this->db->escape($language_code) . "' LIMIT 1");

			if ($language_query->num_rows) {
				$language_id = (int)$language_query->row['language_id'];
			}
		}

		$defaults = array(
			'module_digital_pricelist_status' => 1,
			'module_digital_pricelist_archive_days' => 30,
			'module_digital_pricelist_include_disabled' => 0,
			'module_digital_pricelist_language_id' => $language_id,
			'module_digital_pricelist_customer_group_id' => (int)$this->config->get('config_customer_group_id'),
			'module_digital_pricelist_unit_attribute_id' => 0,
			'module_digital_pricelist_unit_price_attribute_id' => 0,
			'module_digital_pricelist_special_sale_name' => 'Akcijska prodaja',
			'module_digital_pricelist_object_type' => 'Internetska prodavaonica',
			'module_digital_pricelist_object_address' => $this->getCatalogUrl(),
			'module_digital_pricelist_object_code' => 'WEB-01',
			'module_digital_pricelist_cron_token' => $this->createToken()
		);

		foreach ($defaults as $key => $value) {
			if (!array_key_exists($key, $settings) || $settings[$key] === '') {
				$settings[$key] = $value;
			}
		}

		$this->model_setting_setting->editSetting('module_digital_pricelist', $settings);

		$directory = rtrim(DIR_STORAGE, '/\\') . '/digital_pricelist/archive/';

		if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
			throw new RuntimeException('Digital price list storage directory could not be created.');
		}
	}

	public function getRecentRuns($limit = 10) {
		$limit = max(1, min(50, (int)$limit));

		if (!$this->tableExists(DB_PREFIX . 'digital_pricelist_run')) {
			return array();
		}

		return $this->db->query("SELECT * FROM `" . DB_PREFIX . "digital_pricelist_run` ORDER BY digital_pricelist_run_id DESC LIMIT " . $limit)->rows;
	}

	private function tableExists($table_name) {
		$query = $this->db->query('SHOW TABLES');

		foreach ($query->rows as $row) {
			$value = reset($row);

			if ((string)$value === (string)$table_name) {
				return true;
			}
		}

		return false;
	}

	private function createToken() {
		try {
			return bin2hex(random_bytes(32));
		} catch (Throwable $exception) {
			return hash('sha256', uniqid((string)mt_rand(), true));
		}
	}

	private function getCatalogUrl() {
		if (defined('HTTPS_CATALOG') && HTTPS_CATALOG) {
			return HTTPS_CATALOG;
		}

		if (defined('HTTP_CATALOG') && HTTP_CATALOG) {
			return HTTP_CATALOG;
		}

		$url = (string)$this->config->get('config_ssl');

		return $url !== '' ? $url : (string)$this->config->get('config_url');
	}
}

<?php
class ControllerExtensionModuleDigitalPricelist extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/digital_pricelist');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
		$this->load->model('extension/module/digital_pricelist');

		if (($this->request->server['REQUEST_METHOD'] === 'POST') && $this->validate()) {
			$this->request->post['module_digital_pricelist_archive_days'] = max(30, (int)$this->request->post['module_digital_pricelist_archive_days']);
			$this->model_setting_setting->editSetting('module_digital_pricelist', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/digital_pricelist', 'user_token=' . $this->session->data['user_token'], true));
		}

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['error_archive_days'] = isset($this->error['archive_days']) ? $this->error['archive_days'] : '';
		$data['error_cron_token'] = isset($this->error['cron_token']) ? $this->error['cron_token'] : '';
		$data['error_special_sale_name'] = isset($this->error['special_sale_name']) ? $this->error['special_sale_name'] : '';

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		}

		$language_keys = array(
			'heading_title', 'text_home', 'text_extension', 'text_edit', 'text_enabled', 'text_disabled',
			'text_yes', 'text_no', 'text_never', 'text_none', 'text_feed_urls', 'text_cron', 'text_storage', 'text_legal_fields',
			'text_recent_runs', 'text_no_runs', 'text_generate_help', 'text_large_catalog_warning', 'entry_status', 'entry_archive_days',
			'entry_include_disabled', 'entry_cron_token', 'entry_xml_url', 'entry_csv_url', 'entry_cron_url',
			'entry_archives_url', 'entry_cli_command', 'entry_last_generated', 'entry_current_filename', 'entry_archive_files', 'entry_xml_size', 'entry_csv_size',
			'entry_customer_group', 'entry_unit_attribute', 'entry_unit_price_attribute', 'entry_special_sale_name',
			'entry_language', 'entry_object_type', 'entry_object_address', 'entry_object_code',
			'column_generated_at', 'column_status', 'column_products', 'column_duration', 'column_message',
			'button_save', 'button_cancel', 'button_generate', 'help_archive_days', 'help_include_disabled',
			'help_cron_token', 'help_customer_group', 'help_unit_attribute', 'help_unit_price_attribute',
			'help_special_sale_name', 'help_language', 'help_object_identity'
		);

		foreach ($language_keys as $key) {
			$data[$key] = $this->language->get($key);
		}

		$data['breadcrumbs'] = array(
			array(
				'text' => $this->language->get('text_home'),
				'href' => $this->normaliseTemplateUrl($this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true))
			),
			array(
				'text' => $this->language->get('text_extension'),
				'href' => $this->normaliseTemplateUrl($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true))
			),
			array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->normaliseTemplateUrl($this->url->link('extension/module/digital_pricelist', 'user_token=' . $this->session->data['user_token'], true))
			)
		);

		$data['action'] = $this->normaliseTemplateUrl($this->url->link('extension/module/digital_pricelist', 'user_token=' . $this->session->data['user_token'], true));
		$data['generate_action'] = $this->normaliseTemplateUrl($this->url->link('extension/module/digital_pricelist/generate', 'user_token=' . $this->session->data['user_token'], true));
		$data['cancel'] = $this->normaliseTemplateUrl($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));

		$fields = array(
			'module_digital_pricelist_status' => 1,
			'module_digital_pricelist_archive_days' => 30,
			'module_digital_pricelist_include_disabled' => 0,
			'module_digital_pricelist_language_id' => (int)$this->config->get('config_language_id'),
			'module_digital_pricelist_customer_group_id' => (int)$this->config->get('config_customer_group_id'),
			'module_digital_pricelist_unit_attribute_id' => 0,
			'module_digital_pricelist_unit_price_attribute_id' => 0,
			'module_digital_pricelist_special_sale_name' => 'Akcijska prodaja',
			'module_digital_pricelist_object_type' => 'Internetska prodavaonica',
			'module_digital_pricelist_object_address' => $this->getCatalogUrl(),
			'module_digital_pricelist_object_code' => 'WEB-01',
			'module_digital_pricelist_cron_token' => ''
		);
		$text_fields = array(
			'module_digital_pricelist_special_sale_name',
			'module_digital_pricelist_object_type',
			'module_digital_pricelist_object_address',
			'module_digital_pricelist_object_code'
		);

		foreach ($fields as $field => $default) {
			if (isset($this->request->post[$field])) {
				$data[$field] = $this->request->post[$field];
			} elseif ($this->config->get($field) !== null) {
				$data[$field] = $this->config->get($field);
			} else {
				$data[$field] = $default;
			}

			if (in_array($field, $text_fields, true)) {
				// OpenCart Request stores one htmlspecialchars() layer in settings.
				// Decode it once before Twig escapes the value for the form field.
				$data[$field] = $this->decodeDisplayText($data[$field]);
			}
		}

		if (!isset($this->request->post['module_digital_pricelist_object_address']) && trim((string)$data['module_digital_pricelist_object_address']) === '') {
			$data['module_digital_pricelist_object_address'] = $this->getCatalogUrl();
		}

		$catalog_url = $this->getCatalogUrl();
		$route_url = rtrim($catalog_url, '/') . '/index.php?route=extension/module/digital_pricelist/';
		$data['xml_url'] = $route_url . 'xml';
		$data['csv_url'] = $route_url . 'csv';
		$data['archives_url'] = $route_url . 'archives';
		$data['cron_url'] = $route_url . 'cron&token=' . rawurlencode((string)$data['module_digital_pricelist_cron_token']);
		$data['cli_command'] = 'php ' . escapeshellarg(DIR_SYSTEM . 'cli/digital_pricelist.php');

		$this->load->model('customer/customer_group');
		$this->load->model('catalog/attribute');
		$this->load->model('localisation/language');
		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
		$data['attributes'] = $this->model_catalog_attribute->getAttributes();
		$data['languages'] = $this->model_localisation_language->getLanguages();

		foreach ($data['customer_groups'] as &$customer_group) {
			$customer_group['name'] = $this->decodeDisplayText($customer_group['name']);
		}
		unset($customer_group);

		foreach ($data['attributes'] as &$attribute) {
			$attribute['attribute_group'] = $this->decodeDisplayText($attribute['attribute_group']);
			$attribute['name'] = $this->decodeDisplayText($attribute['name']);
		}
		unset($attribute);

		foreach ($data['languages'] as &$language) {
			$language['name'] = $this->decodeDisplayText($language['name']);
		}
		unset($language);

		$this->load->library('digital_pricelist');
		$status = $this->digital_pricelist->getStatus();
		$data['last_generated'] = $status['last_generated'] ? $status['last_generated'] : $this->language->get('text_never');
		$data['current_filename'] = $status['current_base_filename'] ? $status['current_base_filename'] : '—';
		$data['archive_files'] = $status['archive_files'];
		$data['xml_size'] = $this->formatBytes($status['xml_size']);
		$data['csv_size'] = $this->formatBytes($status['csv_size']);
		$data['storage_directory'] = $status['storage_directory'];
		$data['runs'] = $this->model_extension_module_digital_pricelist->getRecentRuns(10);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/digital_pricelist', $data));
	}

	public function generate() {
		$this->load->language('extension/module/digital_pricelist');

		if ($this->request->server['REQUEST_METHOD'] !== 'POST' || !$this->user->hasPermission('modify', 'extension/module/digital_pricelist')) {
			$this->session->data['error_warning'] = $this->language->get('error_permission');
		} else {
			try {
				$this->load->library('digital_pricelist');
				$result = $this->digital_pricelist->generate();
				$this->session->data['success'] = sprintf($this->language->get('text_generated'), (int)$result['product_count']);
			} catch (Throwable $exception) {
				$this->session->data['error_warning'] = sprintf($this->language->get('error_generation'), $exception->getMessage());
			}
		}

		$this->response->redirect($this->url->link('extension/module/digital_pricelist', 'user_token=' . $this->session->data['user_token'], true));
	}

	public function install() {
		$this->load->model('extension/module/digital_pricelist');
		$this->model_extension_module_digital_pricelist->install();

		$this->load->model('user/user_group');
		$route = 'extension/module/digital_pricelist';

		if (!$this->user->hasPermission('access', $route)) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', $route);
		}

		if (!$this->user->hasPermission('modify', $route)) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', $route);
		}
	}

	public function uninstall() {
		// Keep settings, generation history and archives so compliance records are not destroyed.
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSettingValue(
			'module_digital_pricelist',
			'module_digital_pricelist_status',
			0
		);
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/digital_pricelist')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$archive_days = isset($this->request->post['module_digital_pricelist_archive_days'])
			? (int)$this->request->post['module_digital_pricelist_archive_days']
			: 0;

		if ($archive_days < 30 || $archive_days > 3650) {
			$this->error['archive_days'] = $this->language->get('error_archive_days');
		}

		$token = isset($this->request->post['module_digital_pricelist_cron_token'])
			? (string)$this->request->post['module_digital_pricelist_cron_token']
			: '';

		if (!preg_match('/^[A-Za-z0-9_-]{32,128}$/', $token)) {
			$this->error['cron_token'] = $this->language->get('error_cron_token');
		}

		if (!isset($this->request->post['module_digital_pricelist_special_sale_name']) || trim((string)$this->request->post['module_digital_pricelist_special_sale_name']) === '') {
			$this->error['special_sale_name'] = $this->language->get('error_special_sale_name');
		}

		foreach (array('object_type', 'object_address', 'object_code') as $field) {
			$key = 'module_digital_pricelist_' . $field;

			if ((!isset($this->request->post[$key]) || trim((string)$this->request->post[$key]) === '') && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_object_identity');
			}
		}

		return !$this->error;
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

	private function formatBytes($bytes) {
		$bytes = (int)$bytes;

		if ($bytes < 1024) {
			return $bytes . ' B';
		}

		if ($bytes < 1048576) {
			return number_format($bytes / 1024, 1) . ' KB';
		}

		return number_format($bytes / 1048576, 1) . ' MB';
	}

	private function normaliseTemplateUrl($url) {
		return str_replace('&amp;', '&', (string)$url);
	}

	private function decodeDisplayText($value) {
		return html_entity_decode((string)$value, ENT_QUOTES, 'UTF-8');
	}
}

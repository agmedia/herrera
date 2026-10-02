<?php
class ControllerExtensionModuleLegalWarranty extends Controller {
	public function index() {
		return '';
	}

	// Kept as an empty compatibility endpoint for previously installed OCMOD XML.
	public function header() {
		return '';
	}

	public function footer() {
		if (!$this->isEnabled() || !$this->settingEnabled('module_legal_warranty_header_status', true)) {
			return '';
		}

		$data = $this->load->language('extension/module/legal_warranty');
		$data['asset_url'] = $this->assetUrl();
		$data['eu_url'] = $this->euUrl();

		return $this->load->view('extension/module/legal_warranty_footer', $data);
	}

	public function checkout() {
		if (!$this->isEnabled() || !$this->settingEnabled('module_legal_warranty_checkout_status', true)) {
			return '';
		}

		$data = $this->load->language('extension/module/legal_warranty');
		$data['asset_url'] = $this->assetUrl();
		$data['eu_url'] = $this->euUrl();

		return $this->load->view('extension/module/legal_warranty_checkout', $data);
	}

	public function email($setting = array()) {
		if (!$this->isEnabled() || !$this->settingEnabled('module_legal_warranty_email_status', true)) {
			return '';
		}

		if (!empty($setting['language_code']) && is_string($setting['language_code'])) {
			$language = new Language($setting['language_code']);
			$language->load($setting['language_code']);
			$data = $language->load('extension/module/legal_warranty');
		} else {
			$data = $this->load->language('extension/module/legal_warranty');
		}
		$store_url = !empty($setting['store_url']) ? rtrim($setting['store_url'], '/') . '/' : $this->serverUrl();
		$data['asset_url'] = $store_url . 'catalog/view/theme/default/image/legal-warranty/legal-guarantee-notice-hr-color.svg';
		$data['eu_url'] = $this->euUrl();
		$data['return_url'] = $store_url . 'index.php?route=extension/module/legal_return/form';

		return $this->load->view('extension/module/legal_warranty_email', $data);
	}

	private function assetUrl() {
		return $this->serverUrl() . 'catalog/view/theme/default/image/legal-warranty/legal-guarantee-notice-hr-color.svg';
	}

	private function serverUrl() {
		$server = !empty($this->request->server['HTTPS']) ? $this->config->get('config_ssl') : $this->config->get('config_url');
		return rtrim($server, '/') . '/';
	}

	private function euUrl() {
		$url = html_entity_decode(trim((string)$this->config->get('module_legal_warranty_eu_url')), ENT_QUOTES, 'UTF-8');
		return filter_var($url, FILTER_VALIDATE_URL) && parse_url($url, PHP_URL_SCHEME) === 'https' ? $url : 'https://europa.eu/youreurope/citizens/consumers/shopping/guarantees/index_hr.htm';
	}

	private function isEnabled() {
		return $this->settingEnabled('module_legal_warranty_status', false);
	}

	private function settingEnabled($key, $default) {
		$value = $this->config->get($key);
		return ($value === null || $value === '') ? (bool)$default : (bool)$value;
	}
}

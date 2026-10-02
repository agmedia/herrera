<?php
class ControllerExtensionModuleLegalWarranty extends Controller {
	private $error = array();

	public function index() {
		$data = $this->load->language('extension/module/legal_warranty');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$settings = array(
				'module_legal_warranty_status' => !empty($this->request->post['module_legal_warranty_status']) ? 1 : 0,
				'module_legal_warranty_header_status' => !empty($this->request->post['module_legal_warranty_header_status']) ? 1 : 0,
				'module_legal_warranty_checkout_status' => !empty($this->request->post['module_legal_warranty_checkout_status']) ? 1 : 0,
				'module_legal_warranty_email_status' => !empty($this->request->post['module_legal_warranty_email_status']) ? 1 : 0,
				'module_legal_warranty_eu_url' => trim($this->request->post['module_legal_warranty_eu_url'])
			);
			$this->model_setting_setting->editSetting('module_legal_warranty', $settings);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module/legal_warranty', 'user_token=' . $this->session->data['user_token'], true));
		}

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['error_url'] = isset($this->error['url']) ? $this->error['url'] : '';
		$data['success'] = isset($this->session->data['success']) ? $this->session->data['success'] : '';
		unset($this->session->data['success']);

		$data['breadcrumbs'] = array(
			array('text' => $this->language->get('text_home'), 'href' => $this->viewUrl($this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true))),
			array('text' => $this->language->get('text_extension'), 'href' => $this->viewUrl($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true))),
			array('text' => $this->language->get('heading_title'), 'href' => $this->viewUrl($this->url->link('extension/module/legal_warranty', 'user_token=' . $this->session->data['user_token'], true)))
		);
		$data['action'] = $this->viewUrl($this->url->link('extension/module/legal_warranty', 'user_token=' . $this->session->data['user_token'], true));
		$data['cancel'] = $this->viewUrl($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		$data['official_asset'] = HTTPS_CATALOG . 'catalog/view/theme/default/image/legal-warranty/legal-guarantee-notice-hr-color.svg';

		$defaults = array(
			'module_legal_warranty_status' => 0,
			'module_legal_warranty_header_status' => 0,
			'module_legal_warranty_checkout_status' => 0,
			'module_legal_warranty_email_status' => 0,
			'module_legal_warranty_eu_url' => 'https://europa.eu/youreurope/citizens/consumers/shopping/guarantees/index_hr.htm'
		);

		foreach ($defaults as $key => $default) {
			$data[$key] = isset($this->request->post[$key]) && is_scalar($this->request->post[$key]) ? (string)$this->request->post[$key] : (($this->config->get($key) !== null) ? $this->config->get($key) : $default);
		}
		$data['module_legal_warranty_eu_url'] = html_entity_decode((string)$data['module_legal_warranty_eu_url'], ENT_QUOTES, 'UTF-8');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/legal_warranty', $data));
	}

	public function install() {
		$this->load->model('user/user_group');
		if (!$this->user->hasPermission('access', 'extension/module/legal_warranty')) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/legal_warranty');
		}
		if (!$this->user->hasPermission('modify', 'extension/module/legal_warranty')) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/legal_warranty');
		}
		$this->load->model('setting/setting');
		if ($this->config->get('module_legal_warranty_status') === null) {
			$this->model_setting_setting->editSetting('module_legal_warranty', array(
				'module_legal_warranty_status' => 1,
				'module_legal_warranty_header_status' => 1,
				'module_legal_warranty_checkout_status' => 1,
				'module_legal_warranty_email_status' => 1,
				'module_legal_warranty_eu_url' => 'https://europa.eu/youreurope/citizens/consumers/shopping/guarantees/index_hr.htm'
			));
		}
	}

	public function uninstall() {
		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('module_legal_warranty');
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/legal_warranty')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		$url = isset($this->request->post['module_legal_warranty_eu_url']) && is_string($this->request->post['module_legal_warranty_eu_url']) ? trim($this->request->post['module_legal_warranty_eu_url']) : '';
		if (!$url || !filter_var($url, FILTER_VALIDATE_URL) || parse_url($url, PHP_URL_SCHEME) !== 'https') {
			$this->error['url'] = $this->language->get('error_url');
		}
		return !$this->error;
	}

	private function viewUrl($url) {
		return str_replace('&amp;', '&', $url);
	}
}

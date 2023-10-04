<?php
//lib
require_once(DIR_SYSTEM.'library/tmd/system.php');
//lib
class ControllerExtensionModuleTmdOrdertracking extends Controller {
	private $error = array();
	
	public function install() {
	$this->load->model('extension/tmd_ordertracking');
	$this->model_extension_tmd_ordertracking->install();
	}	
	public function uninstall() {
	$this->load->model('extension/tmd_ordertracking');
	$this->model_extension_tmd_ordertracking->uninstall();
	}
	
	public function index() {
		$this->load->language('extension/module/tmd_ordertracking');
		
		$this->registry->set('tmd', new TMD($this->registry));
		$keydata=array(
		'code'=>'tmdkey_tmd_ordertracking',
		'eid'=>'MzkxNTY=',
		'route'=>'extension/module/tmd_ordertracking',
		);
		$tmd_ordertracking=$this->tmd->getkey($keydata['code']);
		$data['getkeyform']=$this->tmd->loadkeyform($keydata);

		$this->document->setTitle($this->language->get('heading_title1'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_tmd_ordertracking', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];
		
			unset($this->session->data['warning']);
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);
        
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/tmd_ordertracking', 'user_token=' . $this->session->data['user_token'], true)
		);
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/tmd_ordertracking', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/tmd_ordertracking', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_tmd_ordertracking_status'])) {
			$data['module_tmd_ordertracking_status'] = $this->request->post['module_tmd_ordertracking_status'];
		} else {
			$data['module_tmd_ordertracking_status'] = $this->config->get('module_tmd_ordertracking_status');
		}
		
		if (isset($this->request->post['module_tmd_ordertracking_shipingcomanie'])) {
			$data['shipingcomanys'] = $this->request->post['module_tmd_ordertracking_shipingcomanie'];
		} else {
			$data['shipingcomanys'] = $this->config->get('module_tmd_ordertracking_shipingcomanie');
		}
		
		if (isset($this->request->post['module_tmd_ordertracking'])) {
			$data['module_tmd_ordertracking'] = $this->request->post['module_tmd_ordertracking'];
		} else {
			$data['module_tmd_ordertracking'] = $this->config->get('module_tmd_ordertracking');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/tmd_ordertracking', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/tmd_ordertracking')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		$tmd_ordertracking=$this->config->get('tmdkey_tmd_ordertracking');
		if (empty(trim($tmd_ordertracking))) {			
		$this->session->data['warning'] ='Module will Work after add License key!';
		$this->response->redirect($this->url->link('extension/module/tmd_ordertracking', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		return !$this->error;
	}
	public function keysubmit() {
		$json = array(); 
		
      	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$keydata=array(
			'code'=>'tmdkey_tmd_ordertracking',
			'eid'=>'MzkxNTY=',
			'route'=>'extension/module/tmd_ordertracking',
			'moduledata_key'=>$this->request->post['moduledata_key'],
			);
			$this->registry->set('tmd', new TMD($this->registry));
            $json=$this->tmd->matchkey($keydata);       
		} 
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
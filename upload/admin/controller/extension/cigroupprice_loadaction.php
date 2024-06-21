<?php
class ControllerExtensionCiGroupPriceloadaction extends Controller {
	private $error = array();

	private $module_token = '';
	private $ci_token = '';

	public function __construct($registry) {
		parent :: __construct($registry);

		if(VERSION <= '2.3.0.2') {
			$this->module_token = 'token';
			$this->ci_token = $this->session->data['token'];
		} else {
			$this->module_token = 'user_token';
			$this->ci_token = $this->session->data['user_token'];
		}
	}

	public function index($setting) {
		$this->load->language('extension/cigroupprice_loadaction');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_base_price'] = $this->language->get('entry_base_price');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_value'] = $this->language->get('entry_value');
		$data['entry_action'] = $this->language->get('entry_action');
		$data['entry_custom_price'] = $this->language->get('entry_custom_price');
		$data['entry_fixed_amount'] = $this->language->get('entry_fixed_amount');
		$data['entry_percentage'] = $this->language->get('entry_percentage');
		$data['entry_all_products'] = $this->language->get('entry_all_products');
		$data['entry_custom_products'] = $this->language->get('entry_custom_products');
		$data['entry_categories'] = $this->language->get('entry_categories');
		$data['entry_manufacturers'] = $this->language->get('entry_manufacturers');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_update_existing'] = $this->language->get('entry_update_existing');
		$data['entry_template_name'] = $this->language->get('entry_template_name');

		$data['help_import_excel'] = $this->language->get('help_import_excel');

		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_ignore'] = $this->language->get('text_ignore');
		$data['text_inserted'] = $this->language->get('text_inserted');
		$data['text_updated'] = $this->language->get('text_updated');
		$data['text_skip'] = $this->language->get('text_skip');
		$data['text_reason'] = $this->language->get('text_reason');
		$data['text_choose'] = $this->language->get('text_choose');
		$data['text_choose_option'] = $this->language->get('text_choose_option');
		$data['text_action_customer_group'] = $this->language->get('text_action_customer_group');
		$data['text_applyon_catalog'] = $this->language->get('text_applyon_catalog');

		$data['text_xls'] = $this->language->get('text_xls');
		$data['text_xlsx'] = $this->language->get('text_xlsx');
		$data['text_csv'] = $this->language->get('text_csv');

		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_format'] = $this->language->get('entry_format');
		$data['entry_filter_type'] = $this->language->get('entry_filter_type');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_all_options'] = $this->language->get('entry_all_options');
		$data['entry_custom_options'] = $this->language->get('entry_custom_options');
		$data['entry_exclude_product'] = $this->language->get('entry_exclude_product');

		$data['entry_import_excel'] = $this->language->get('entry_import_excel');

		$data['excel_sample'] = 'https://demo.codinginspect.com/quick-contact/samplefile/SampleGroupPrices.xlsx';

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_apply'] = $this->language->get('button_apply');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_example'] = $this->language->get('button_example');

		$data['tab_export'] = $this->language->get('tab_export');
		$data['tab_import'] = $this->language->get('tab_import');
		$data['tab_support'] = $this->language->get('tab_support');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', $this->module_token .'=' . $this->ci_token, true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', $this->module_token .'=' . $this->ci_token . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/cigroupprice_loadaction', $this->module_token .'=' . $this->ci_token, true)
		);

		$data['action'] = $this->url->link('extension/cigroupprice_loadaction', $this->module_token .'=' . $this->ci_token, true);

		$data['cancel'] = $this->url->link('extension/extension', $this->module_token .'=' . $this->ci_token . '&type=module', true);

		$data['customer_group_price'] = isset($setting['customer_group_price']) ? $setting['customer_group_price'] : array();
		$data['filter_type'] = isset($setting['filter_type']) ? $setting['filter_type'] : 'all';
		
		$data['products'] = array();
		$this->load->model('catalog/product');
		$products = isset($setting['filter_products']) ? $setting['filter_products'] : array();
		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}

		$data['exclude_products'] = array();
		$exclude_products = isset($setting['filter_exclude_products']) ? $setting['filter_exclude_products'] : array();
		foreach ($exclude_products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$data['exclude_products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}


		if(isset($setting) && !empty($setting)) {
			$data['delete_action'] = true;
		}else{
			$data['delete_action'] = false;
		}

		$data['filter_categories'] = isset($setting['categories']) ? $setting['categories'] : array();
		$data['filter_manufacturers'] = isset($setting['manufacturers']) ? $setting['manufacturers'] : array();
		$data['product_options'] = isset($setting['product_option']) ? $setting['product_option'] : array();
		$data['option_values'] = array();
		$this->load->model('catalog/option');
		foreach ($data['product_options'] as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				if (!isset($data['option_values'][$product_option['option_id']])) {
					$data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
				}
			}
		}

		$route = isset($this->request->get['route']) ? $this->request->get['route'] : '';
		if($route == 'extension/cigroupprice_product' || $route == 'extension/cigroupprice_product/autocomplete'|| $route == 'extension/cigroupprice_product/deleteTemplate' || $route == 'extension/cigroupprice_product/getTemplate') {
			$data['page_type'] = 'product';
			$data['entry_price'] = $this->language->get('entry_product_price');
		}else{
			$data['page_type'] = 'product_option';
			$data['entry_price'] = $this->language->get('entry_option_price');
		}
		
		// Stores
		$this->load->model('setting/store');

		$data['stores'] = array();

		$data['stores'][] = array(
			'store_id' => 0,
			'name'     => $this->language->get('text_default'),
		);

		$stores = $this->model_setting_store->getStores();

		foreach ($stores as $store) {
			$data['stores'][] = array(
				'store_id' => $store['store_id'],
				'name'     => $store['name'],
			);
		}

		$this->load->model('customer/customer_group');

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		$this->load->model('catalog/category');

		$data['categories'] = $this->model_catalog_category->getCategories(array('sort' => 'name'));

		$this->load->model('catalog/manufacturer');

		$data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();

		$data['ci_token'] = $this->ci_token;
		$data['module_token'] = $this->module_token;

		if(VERSION <= '2.3.0.2') {
			 return $this->load->view('extension/cigroupprice_loadaction.tpl', $data);
		} else {
			$file_variable = 'template_engine';
			$file_type = 'template';
			$this->config->set($file_variable, $file_type);
			return $this->load->view('extension/cigroupprice_loadaction', $data);
		}
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/cigroupprice_loadaction')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
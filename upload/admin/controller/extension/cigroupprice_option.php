<?php
class ControllerExtensionCiGroupPriceoption extends Controller {
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

	public function index() {
		$this->document->addStyle('view/stylesheet/cigroupprice/bulkupdate.css');

		$this->load->language('extension/cigroupprice_option');

		$this->load->model('extension/cigroupprice');

		$this->model_extension_cigroupprice->BuildTableProductPriceGroup();

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['legend_export'] = $this->language->get('legend_export');
		$data['legend_import'] = $this->language->get('legend_import');

		$data['help_import_excel'] = $this->language->get('help_import_excel');

		$data['text_main_product'] = $this->language->get('text_main_product');
		$data['text_option_value'] = $this->language->get('text_option_value');
		$data['text_total_rows'] = $this->language->get('text_total_rows');
		$data['text_ignore'] = $this->language->get('text_ignore');
		$data['text_inserted'] = $this->language->get('text_inserted');
		$data['text_updated'] = $this->language->get('text_updated');
		$data['text_skip'] = $this->language->get('text_skip');
		$data['text_reason'] = $this->language->get('text_reason');
		$data['text_choose'] = $this->language->get('text_choose');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['text_xls'] = $this->language->get('text_xls');
		$data['text_xlsx'] = $this->language->get('text_xlsx');
		$data['text_csv'] = $this->language->get('text_csv');

		$data['text_none'] = $this->language->get('text_none');
		$data['type_all_products'] = $this->language->get('type_all_products');
		$data['type_custom_products'] = $this->language->get('type_custom_products');
		$data['type_only_customer_group_prices'] = $this->language->get('type_only_customer_group_prices');
		$data['type_ignore_customer_group_prices'] = $this->language->get('type_ignore_customer_group_prices');

		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_all_options'] = $this->language->get('entry_all_options');
		$data['entry_custom_options'] = $this->language->get('entry_custom_options');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_format'] = $this->language->get('entry_format');
		$data['entry_filter_type'] = $this->language->get('entry_filter_type');
		$data['entry_template_name'] = $this->language->get('entry_template_name');
		$data['entry_template_setting'] = $this->language->get('entry_template_setting');
		$data['entry_select_template'] = $this->language->get('entry_select_template');

		$data['entry_import_excel'] = $this->language->get('entry_import_excel');

		$data['excel_sample'] = 'https://demo.codinginspect.com/quick-contact/samplefile/SampleGroupPrices.xlsx';

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_add'] = $this->language->get('button_add');

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

		if(VERSION <= '2.3.0.2') {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_extension'),
				'href' => $this->url->link('extension/extension', $this->module_token .'=' . $this->ci_token . '&type=module', true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_extension'),
				'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
			);
		}

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/cigroupprice_option', $this->module_token .'=' . $this->ci_token, true)
		);

		$data['action'] = $this->url->link('extension/cigroupprice_option', $this->module_token .'=' . $this->ci_token, true);

		$data['cancel'] = $this->url->link('extension/cigroupprice_option', $this->module_token .'=' . $this->ci_token . '&type=module', true);

		$data['product_options'] = array();

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

		$data['ci_token'] = $this->ci_token;
		$data['module_token'] = $this->module_token;

		$this->load->model('extension/cigroupprice_product');

		$data['templates'] = $this->model_extension_cigroupprice_product->getTemplates(['filter_type' => 'product_option']);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['cigroupprice_loadaction'] = $this->load->controller('extension/cigroupprice_loadaction');

		if(VERSION <= '2.3.0.2') {
			$this->response->setOutput($this->load->view('extension/cigroupprice_option.tpl', $data));
		} else {
			$file_variable = 'template_engine';
			$file_type = 'template';
			$this->config->set($file_variable, $file_type);
			$this->response->setOutput($this->load->view('extension/cigroupprice_option', $data));
		}
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/cigroupprice_option')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function addTemplate() {
		$this->load->language('extension/cigroupprice_option');
		$this->load->model('extension/cigroupprice_product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['template_name']) < 1) || (utf8_strlen($this->request->post['template_name']) > 64)) {
				$json['error']['template_name'] = $this->language->get('error_template_name');
			}

			if($this->request->post['template_name']) {
				$template_info = $this->model_extension_cigroupprice_product->getTemplatebyName($this->request->post['template_name']);

				if($template_info) {
					$json['error']['template_name'] = $this->language->get('error_template_name_exist');
				}
			}

			if(!isset($json['error'])) {
				$this->request->post['type'] = 'product_option';
				$json['template_id'] = $this->model_extension_cigroupprice_product->addTemplate($this->request->post);
				$json['templates'] = $this->model_extension_cigroupprice_product->getTemplates(['filter_type' => 'product_option']);
				$json['success'] = $this->language->get('text_success_template');
			}
		}


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function editTemplate() {
		$this->load->language('extension/cigroupprice_option');
		$this->load->model('extension/cigroupprice_product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['template_name']) < 1) || (utf8_strlen($this->request->post['template_name']) > 64)) {
				$json['error']['template_name'] = $this->language->get('error_template_name');
			}

			if(!isset($json['error'])) {
				$this->request->post['type'] = 'product_option';
				$this->model_extension_cigroupprice_product->editTemplate($this->request->post);
				$json['success'] = $this->language->get('text_success_template');
			}
		}


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function applyTemplate() {
		$this->load->language('extension/cigroupprice_option');
		$this->load->model('extension/cigroupprice_product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if(!isset($this->request->post['product_option'])) {
				$json['error']['no_product_option'] = $this->language->get('error_no_product_option');
			}
			foreach ($this->request->post['customer_group_price'] as $customer_group_id => $customer_group_price) {
				if (isset($customer_group_price['status'])) {
					if (!$customer_group_price['basedon']) {
						if (($customer_group_price['custom_price'] < 0)) {
							$json['error']['custom_price'][$customer_group_id] = $this->language->get('error_custom_price');
						}
					}

					if (($customer_group_price['value'] < 0)) {
						$json['error']['value'][$customer_group_id] = $this->language->get('error_value');
					}
				}
			}

			if ($this->request->post['filter_type'] == 'custom_product') {
				if(!isset($this->request->post['filter_products'])) {
					$json['error']['no_selected_product'] = $this->language->get('error_no_selected_product');
				}	
			} else if ($this->request->post['filter_type'] == 'custom_category') {
				if(!isset($this->request->post['categories'])) {
					$json['error']['no_selected_category'] = $this->language->get('error_no_selected_category');
				}
			} else if ($this->request->post['filter_type'] == 'custom_manufacturer') {
				if(!isset($this->request->post['manufacturers'])) {
					$json['error']['no_selected_manufacturer'] = $this->language->get('error_no_selected_manufacturer');
				}		
			}

			if(!isset($json['error'])) {
				$this->model_extension_cigroupprice_product->updateOptionPrice($this->request->post);
				$json['success'] = $this->language->get('text_success');
			}
		}


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function optionAutocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->language('catalog/option');

			$this->load->model('catalog/option');
			$this->load->model('extension/cigroupprice_product');

			$this->load->model('tool/image');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 5
			);

			$options = $this->model_extension_cigroupprice_product->getOptions($filter_data);

			foreach ($options as $option) {
				$option_value_data = array();

				if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox') {
					$option_values = $this->model_catalog_option->getOptionValues($option['option_id']);

					foreach ($option_values as $option_value) {
						$option_value_data[] = array(
							'option_value_id' => $option_value['option_value_id'],
							'name'            => strip_tags(html_entity_decode($option_value['name'], ENT_QUOTES, 'UTF-8')),
						);
					}

					$sort_order = array();

					foreach ($option_value_data as $key => $value) {
						$sort_order[$key] = $value['name'];
					}

					array_multisort($sort_order, SORT_ASC, $option_value_data);


					$type = $this->language->get('text_choose');

					$json[] = array(
						'option_id'    => $option['option_id'],
						'name'         => strip_tags(html_entity_decode($option['name'], ENT_QUOTES, 'UTF-8')),
						'category'     => $type,
						'type'         => $option['type'],
						'option_value' => $option_value_data
					);
				}
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('extension/cigroupprice_product');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_type'])) {
				$filter_type = $this->request->get['filter_type'];
			} else {
				$filter_type = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_type'  => $filter_type,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_extension_cigroupprice_product->getTemplates($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'template_id' => $result['template_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'type'      => $result['type'],
					'setting'      => $this->load->controller('extension/cigroupprice_loadaction',json_decode($result['setting'], true))
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getTemplate() {
		$json = array();

		if (isset($this->request->get['filter_id'])) {
			$this->load->model('extension/cigroupprice_product');
		
			if (isset($this->request->get['filter_id'])) {
				$filter_id = $this->request->get['filter_id'];
			} else {
				$filter_id = '';
			}

			$result = $this->model_extension_cigroupprice_product->getTemplate($filter_id);

			if($result) {
				$html = $this->load->controller('extension/cigroupprice_loadaction',json_decode($result['setting'], true));
			} else {
				$html = $this->load->controller('extension/cigroupprice_loadaction');
			}

			$this->response->setOutput($html);
			
		}
	}

	public function deleteTemplate() {
		$this->load->language('extension/cigroupprice_option');
		$this->load->model('extension/cigroupprice_product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if(isset($this->request->post['template_id'])) {
				$template_id = $this->request->post['template_id'];
			}else{
				$template_id = 0;
			}

			if(!isset($json['error'])) {
				$this->model_extension_cigroupprice_product->deleteTemplate($template_id);
				$json['success'] = $this->language->get('text_success_template');
				$json['templates'] = $this->model_extension_cigroupprice_product->getTemplates(['filter_type' => 'product_option']);
				$json['cigroupprice_loadaction'] = $this->load->controller('extension/cigroupprice_loadaction');
			}
		}


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}
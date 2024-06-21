<?php
// Autoloader
require_once(DIR_SYSTEM . 'library/cigroup/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ControllerExtensionCiGroupPrice extends Controller {
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
		$this->document->addStyle('view/stylesheet/cigroupprice/style.css');

		$this->load->language('extension/cigroupprice');

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

		$data['text_xls'] = $this->language->get('text_xls');
		$data['text_xlsx'] = $this->language->get('text_xlsx');
		$data['text_csv'] = $this->language->get('text_csv');

		$data['type_all_products'] = $this->language->get('type_all_products');
		$data['type_custom_products'] = $this->language->get('type_custom_products');
		$data['type_only_customer_group_prices'] = $this->language->get('type_only_customer_group_prices');
		$data['type_ignore_customer_group_prices'] = $this->language->get('type_ignore_customer_group_prices');

		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_format'] = $this->language->get('entry_format');
		$data['entry_filter_type'] = $this->language->get('entry_filter_type');

		$data['entry_import_excel'] = $this->language->get('entry_import_excel');

		$data['excel_sample'] = 'https://demo.codinginspect.com/quick-contact/samplefile/SampleGroupPrices.xlsx';

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_export'] = $this->language->get('button_export');
		$data['button_import'] = $this->language->get('button_import');
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
			'href' => $this->url->link('extension/cigroupprice', $this->module_token .'=' . $this->ci_token, true)
		);

		$data['action'] = $this->url->link('extension/cigroupprice', $this->module_token .'=' . $this->ci_token, true);

		$data['cancel'] = $this->url->link('extension/extension', $this->module_token .'=' . $this->ci_token . '&type=module', true);

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

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		if(VERSION <= '2.3.0.2') {
			$this->response->setOutput($this->load->view('extension/cigroupprice.tpl', $data));
		} else {
			$file_variable = 'template_engine';
			$file_type = 'template';
			$this->config->set($file_variable, $file_type);
			$this->response->setOutput($this->load->view('extension/cigroupprice', $data));
		}
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/cigroupprice')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function phpinfo() {
		phpinfo();
	}

	public function ImportExcel() {
		$json = [];

		$this->load->language('extension/cigroupprice');

		$this->load->model('extension/cigroupprice');
		$this->load->model('customer/customer_group');
		$this->load->model('catalog/product');

		if(empty($this->request->files['file_excel'])) {
			$json['warning'] = $this->language->get('error_no_file');
		}

		if(empty($this->request->files['file_excel'])) {
			$json['warning'] = $this->language->get('error_no_file');
		}

		if(!isset($this->request->files['file_excel']['name'])) {
			$json['warning'] = $this->language->get('error_no_file');
		}


	    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($this->request->files['file_excel']['type']) && !in_array($this->request->files['file_excel']['type'], $file_mimes)) {
			$json['warning'] = $this->language->get('error_wrong_file');
		}

		if (isset($this->request->files['file_excel']) && $this->request->files['file_excel']['error'] != UPLOAD_ERR_OK) {
			$json['warning'] = $this->language->get('error_upload_' . $this->request->files['file_excel']['error']);
		}

		if(!$json) {

	    	$arr_file = explode('.', $this->request->files['file_excel']['name']);
	    	$extension = end($arr_file);

	    	if($extension == 'xlsx') {
	            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	        } else if($extension == 'xls') {
	            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
	        } else if($extension == 'csv') {
	            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	        } else {
	        	$reader = '';
	        }

	        $spreadsheet = $reader->load($this->request->files['file_excel']['tmp_name']);
			$sheetdata = $spreadsheet->getSheet(0)->toArray();

			$reason_text = '';

			$excel_row = 0;
			$skip_row = 0;
			$edit_row = 0;
			$new_row = 0;
			$fixed_row = 0;
			if (!empty($sheetdata)) {
				foreach($sheetdata as $sheet_value) {
					if($excel_row != 0) {
						$product_id = isset($sheet_value[0]) ? $sheet_value[0] : '';
						$product_name = isset($sheet_value[1]) ? $sheet_value[1] : '';
						$group_id = isset($sheet_value[2]) ? $sheet_value[2] : '';
						$group_name = isset($sheet_value[3]) ? $sheet_value[3] : '';
						$group_price = isset($sheet_value[4]) ? $sheet_value[4] : '';

						$product_info = $this->model_catalog_product->getProduct($product_id);
						if($product_info) {
    						$send_data = [
    							'product_id'			=> $product_id,
    							'product_name'			=> $product_name,
    							'group_id'				=> $group_id,
    							'group_name'			=> $group_name,
    							'group_price'			=> $group_price,
    						];

							$group_price_info = $this->model_extension_cigroupprice->getCustomerGroupPrice($group_id, $product_id);

    						if($group_price_info) {
    							// Edit Customer Group Price For Main Product
    							$this->model_extension_cigroupprice->EditGroupPriceByExcel($send_data);
    							$edit_row++;
    						} else {
    							// Add Customer Group Price For Main Product
    							if($send_data['group_price'] != '') {
    								$this->model_extension_cigroupprice->AddGroupPriceByExcel($send_data);
    								$new_row++;
    							} else {
    								$skip_row++;
    								$reason_text = $this->language->get('skip_empty');
    							}
    						}
						} else {
							$skip_row++;
						}
					} else {
						$fixed_row++;
					}

					$excel_row++;
				}
			}

		    $json['success'] = $this->language->get('import_success');
		    $json['count_row'] = [
		    	'excel_row'			=> $excel_row,
		    	'fixed_row'			=> $fixed_row,
		    	'new_row'			=> $new_row,
		    	'edit_row'			=> $edit_row,
		    	'skip_row'			=> $skip_row,
		    	'reason_text'		=> $reason_text,
		    ];


		    // Second Sheet For Product Options With Customer Group Price
		    $option_sheetdata = $spreadsheet->getSheet(1)->toArray();

			$reason_text = '';

			$excel_row = 0;
			$skip_row = 0;
			$edit_row = 0;
			$new_row = 0;
			$fixed_row = 0;

			if (!empty($option_sheetdata)) {
				foreach($option_sheetdata as $option_sheet_value) {
					if($excel_row != 0) {
						$product_id = isset($option_sheet_value[0]) ? $option_sheet_value[0] : '';
						$product_name = isset($option_sheet_value[1]) ? $option_sheet_value[1] : '';
						$product_option_id = isset($option_sheet_value[2]) ? $option_sheet_value[2] : '';
						$product_option_name = isset($option_sheet_value[3]) ? $option_sheet_value[3] : '';
						$product_option_value_id = isset($option_sheet_value[4]) ? $option_sheet_value[4] : '';
						$product_option_value_name = isset($option_sheet_value[5]) ? $option_sheet_value[5] : '';
						$group_id = isset($option_sheet_value[6]) ? $option_sheet_value[6] : '';
						$group_name = isset($option_sheet_value[7]) ? $option_sheet_value[7] : '';
						$group_price = isset($option_sheet_value[8]) ? $option_sheet_value[8] : '';

						$product_info = $this->model_catalog_product->getProduct($product_id);
						$product_option_value_info = $this->model_extension_cigroupprice->getProductOptionValue($product_id, $product_option_id, $product_option_value_id);
						if($product_info && $product_option_value_info) {
    						$send_option_value_data = [
    							'product_id'						=> $product_id,
    							'product_name'						=> $product_name,
    							'product_option_id'					=> $product_option_id,
    							'product_option_name'				=> $product_option_name,
    							'product_option_value_id'			=> $product_option_value_id,
    							'product_option_value_name'			=> $product_option_value_name,
    							'group_id'							=> $group_id,
    							'group_name'						=> $group_name,
    							'group_price'						=> $group_price,
    						];

							$option_value_group_price_info = $this->model_extension_cigroupprice->getCustomerGroupProductOptionPrice($group_id, $product_id, $product_option_id, $product_option_value_id);

    						if($option_value_group_price_info) {
    							// Edit Customer Group Price For Main Product
    							$this->model_extension_cigroupprice->EditOptionValueGroupPriceByExcel($send_option_value_data);
    							$edit_row++;
    						} else {
    							// Add Customer Group Price For Main Product
    							if($send_option_value_data['group_price'] != '') {
	    							$this->model_extension_cigroupprice->AddOptionValueGroupPriceByExcel($send_option_value_data);

	    							$new_row++;
    							} else {
    								$skip_row++;
    								$reason_text = $this->language->get('skip_empty');
    							}
    						}
						} else {
							$skip_row++;
						}
					} else {
						$fixed_row++;
					}

					$excel_row++;
				}
			}

			$json['count_option_row'] = [
		    	'excel_row'			=> $excel_row,
		    	'fixed_row'			=> $fixed_row,
		    	'new_row'			=> $new_row,
		    	'edit_row'			=> $edit_row,
		    	'skip_row'			=> $skip_row,
		    	'reason_text'		=> $reason_text,
		    ];
		}


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

	}

	public function ExportExcel() {
		$json = [];

		$this->load->language('extension/cigroupprice');

		$this->load->model('extension/cigroupprice');
		$this->load->model('customer/customer_group');

		if(isset($this->request->post['filter_store_id'])) {
			$filter_store_id = $this->request->post['filter_store_id'];
		} else {
			$filter_store_id = 0;
		}

		if(isset($this->request->post['filter_type'])) {
			$filter_type = $this->request->post['filter_type'];
		} else {
			$filter_type = 'ONLY_CIGROUP';
		}

		if(isset($this->request->post['filter_categories'])) {
			$filter_categories = $this->request->post['filter_categories'];
		} else {
			$filter_categories = [];
		}

		if(isset($this->request->post['filter_products'])) {
			$filter_products = $this->request->post['filter_products'];
		} else {
			$filter_products = [];
		}

		if(isset($this->request->post['filter_format'])) {
			$filter_format = $this->request->post['filter_format'];
		} else {
			$filter_format = 'xls';
		}

		if($filter_type == 'CUSTOM') {
			if(empty($this->request->post['filter_categories']) && empty($this->request->post['filter_products'])) {
				$json['error'] = $this->language->get('error_custom');
			}
		}

		if(!$json) {
	    	$i = 1;
			$ci_column = 'A';

		    $this->spreadsheet = new Spreadsheet;

		    // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			//Specify the properties for this document
			    $this->spreadsheet->getProperties()
			    ->setCreator("CodingInspect")
			    ->setLastModifiedBy("codinginspect.com")
			    ->setTitle("Customer Group Price")
			    ->setSubject("Customer Group Price")
			    ->setDescription("Customer Group Price")
			    ->setKeywords("Customer Group Price")
			    ->setCategory("Customer Group Price");

	    	$this->spreadsheet->setActiveSheetIndex(0);
		    $sheet = $this->spreadsheet->getActiveSheet();

			$sheet->setCellValue($ci_column . $i, $this->language->get('xls_product_id'))->getColumnDimension($ci_column)->setAutoSize(true);
			$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

			$sheet->setCellValue($ci_column . $i, $this->language->get('xls_product_name'))->getColumnDimension($ci_column)->setAutoSize(true);
			$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

			$sheet->setCellValue($ci_column . $i, $this->language->get('xls_customer_group_id'))->getColumnDimension($ci_column)->setAutoSize(true);
			$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

			$sheet->setCellValue($ci_column . $i, $this->language->get('xls_customer_group_name'))->getColumnDimension($ci_column)->setAutoSize(true);
			$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

			$sheet->setCellValue($ci_column . $i, $this->language->get('xls_customer_group_price'))->getColumnDimension($ci_column)->setAutoSize(true);
			$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);


			// Background Color
			$sheet->getStyle('A1:'.$sheet->getHighestColumn().'1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0061e0');

			// Font Color
			$sheet->getStyle('A1:'.$sheet->getHighestColumn().'1')->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFF');

			$sheet->setTitle('Products');

			$filter_data = array(
				'sort'							=> 'pd.name',
				'order'							=> 'ASC',
				'filter_store_id'				=> $filter_store_id,
				'filter_type'					=> $filter_type,
				'filter_categories'				=> $filter_categories,
				'filter_products'				=> $filter_products,
			);

			$results = $this->model_extension_cigroupprice->getProductsByCustomerGroupPrices($filter_data);

			$all_customer_groups = $this->model_customer_customer_group->getCustomerGroups();

			// Custom Products, ALL Products, Ignore Customer Group Price List
			if(in_array($filter_type, ['CUSTOM', 'ALL', 'IGNORE_CIGROUP'])) {
				// Each Product
				foreach($results as $result) {
					// Each Customer Group
					foreach($all_customer_groups as $customer_group) {
						$customer_group_info = $this->model_customer_customer_group->getCustomerGroup($customer_group['customer_group_id']);
						if($customer_group_info) {
							$result['group_id'] = $customer_group_info['customer_group_id'];
							$result['group_name'] = $customer_group_info['name'];
						} else {
							$result['group_name'] = '';
						}

						$group_price_info = $this->model_extension_cigroupprice->getGroupPrice($customer_group['customer_group_id'], $result['product_id']);
						if($group_price_info) {
							$group_price = $group_price_info['group_price'];
						} else {
							$group_price = '';
						}


						$status = true;

						// Ignore Price List
						if(in_array($filter_type, ['IGNORE_CIGROUP'])) {
							if($group_price) {
								$status = false;
							}
						}

						// Per Row
						if($status) {
							$ci_values = 'A';
							$i++;

							$sheet->setCellValue($ci_values++ . $i, $result['product_id']);
							$sheet->setCellValue($ci_values++ . $i, html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'));
							$sheet->setCellValue($ci_values++ . $i, $result['group_id']);
							$sheet->setCellValue($ci_values++ . $i, $result['group_name']);
							$sheet->setCellValue($ci_values++ . $i, $group_price);
						}
					}
				}
			}

			// Only Customer Group Price List
			if(in_array($filter_type, ['ONLY_CIGROUP'])) {
				// Each Product
				foreach($results as $result) {
					$customer_group_info = $this->model_customer_customer_group->getCustomerGroup($result['group_id']);
					if($customer_group_info) {
						$result['group_id'] = $customer_group_info['customer_group_id'];
						$result['group_name'] = $customer_group_info['name'];
					} else {
						$result['group_name'] = '';
					}

					$group_price = $result['group_price'];

					$ci_values = 'A';
					$i++;

					$sheet->setCellValue($ci_values++ . $i, $result['product_id']);
					$sheet->setCellValue($ci_values++ . $i, $result['name']);
					$sheet->setCellValue($ci_values++ . $i, $result['group_id']);
					$sheet->setCellValue($ci_values++ . $i, $result['group_name']);
					$sheet->setCellValue($ci_values++ . $i, $group_price);
				}
			}

// Create a new sheet for product options
$this->spreadsheet->createSheet();
$this->spreadsheet->setActiveSheetIndex(1);
$sheet = $this->spreadsheet->getActiveSheet();

$i = 1;
$ci_column = 'A';

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_product_id'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_product_name'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_product_option_id'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_product_option_name'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_product_option_value_id'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_product_option_value_name'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_customer_group_id'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_customer_group_name'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

$sheet->setCellValue($ci_column . $i, $this->language->get('xls_customer_group_price'))->getColumnDimension($ci_column)->setAutoSize(true);
$sheet->getStyle($ci_column++ .$i)->getAlignment()->setWrapText(true);

// Background Color
$sheet->getStyle('A1:'.$sheet->getHighestColumn().'1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0061e0');

// Font Color
$sheet->getStyle('A1:'.$sheet->getHighestColumn().'1')->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFF');

$sheet->setTitle('Product Options');

$results = $this->model_extension_cigroupprice->getProductOptionsByCustomerGroupPrices($filter_data);
// Custom Products Options, ALL Products Options, Ignore Customer Group Price List
if(in_array($filter_type, ['CUSTOM', 'ALL', 'IGNORE_CIGROUP'])) {
	// Each Product Options
	foreach($results as $result) {

		// Each Customer Group
		foreach($all_customer_groups as $customer_group) {
			$customer_group_info = $this->model_customer_customer_group->getCustomerGroup($customer_group['customer_group_id']);
			if($customer_group_info) {
				$result['group_id'] = $customer_group_info['customer_group_id'];
				$result['group_name'] = $customer_group_info['name'];
			} else {
				$result['group_name'] = '';
			}

			$option_info = $this->model_extension_cigroupprice->getProductOptionName($result['product_option_id'], $result['product_id']);
			if($option_info) {
				$option_name = $option_info['name'];
			} else {
				$option_name = '';
			}

			$option_value_info = $this->model_extension_cigroupprice->getProductValueOptionName($result['product_option_value_id'], $result['product_id']);
			if($option_value_info) {
				$option_value_name = $option_value_info['name'];
			} else {
				$option_value_name = '';
			}

			$group_price_info = $this->model_extension_cigroupprice->getOptionValueGroupPrice($customer_group['customer_group_id'], $result['product_id'], $result['product_option_value_id']);
			if($group_price_info) {
				$group_price = $group_price_info['group_price'];
			} else {
				$group_price = '';
			}


			$status = true;

			// Ignore Price List
			if(in_array($filter_type, ['IGNORE_CIGROUP'])) {
				if($group_price) {
					$status = false;
				}
			}

			// Per Options Value Row
			if($status) {
				$ci_values = 'A';
				$i++;

				$sheet->setCellValue($ci_values++ . $i, $result['product_id']);
				$sheet->setCellValue($ci_values++ . $i, html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'));
				$sheet->setCellValue($ci_values++ . $i, $result['product_option_id']);
				$sheet->setCellValue($ci_values++ . $i, $option_name);
				$sheet->setCellValue($ci_values++ . $i, $result['product_option_value_id']);
				$sheet->setCellValue($ci_values++ . $i, $option_value_name);

				$sheet->setCellValue($ci_values++ . $i, $result['group_id']);
				$sheet->setCellValue($ci_values++ . $i, $result['group_name']);
				$sheet->setCellValue($ci_values++ . $i, $group_price);
			}
		}
	}
}

// Only Customer Group Price List
if(in_array($filter_type, ['ONLY_CIGROUP'])) {
	// Each Product Options
	foreach($results as $result) {
		$customer_group_info = $this->model_customer_customer_group->getCustomerGroup($result['group_id']);
		if($customer_group_info) {
			$result['group_id'] = $customer_group_info['customer_group_id'];
			$result['group_name'] = $customer_group_info['name'];
		} else {
			$result['group_name'] = '';
		}

		$option_info = $this->model_extension_cigroupprice->getProductOptionName($result['product_option_id'], $result['product_id']);
		if($option_info) {
			$option_name = $option_info['name'];
		} else {
			$option_name = '';
		}

		$option_value_info = $this->model_extension_cigroupprice->getProductValueOptionName($result['product_option_value_id'], $result['product_id']);
		if($option_value_info) {
			$option_value_name = $option_value_info['name'];
		} else {
			$option_value_name = '';
		}

		$group_price = $result['group_price'];

		$ci_values = 'A';
		$i++;

		$sheet->setCellValue($ci_values++ . $i, $result['product_id']);
		$sheet->setCellValue($ci_values++ . $i, $result['name']);

		$sheet->setCellValue($ci_values++ . $i, $result['product_option_id']);
		$sheet->setCellValue($ci_values++ . $i, $option_name);
		$sheet->setCellValue($ci_values++ . $i, $result['product_option_value_id']);
		$sheet->setCellValue($ci_values++ . $i, $option_value_name);

		$sheet->setCellValue($ci_values++ . $i, $result['group_id']);
		$sheet->setCellValue($ci_values++ . $i, $result['group_name']);
		$sheet->setCellValue($ci_values++ . $i, $group_price);
	}
}

// Final Step for Active First Sheet
$this->spreadsheet->setActiveSheetIndex(0);
$this->spreadsheet->getActiveSheet();


$maxWidth = 15;
foreach ($this->spreadsheet->getAllSheets() as $sheet) {
    $sheet->calculateColumnWidths();

    foreach ($sheet->getColumnDimensions() as $colDim) {
        if (!$colDim->getAutoSize()) {
            continue;
        }
        $colWidth = $colDim->getWidth();

        if ($colWidth > $maxWidth) {
            $colDim->setAutoSize(false);
            $colDim->setWidth($maxWidth);
        }
    }
}

			if($filter_format == 'xlsx') {
				$filename = 'customer_group_price.xlsx';
				$writer = new Xlsx($this->spreadsheet);
			}

			if($filter_format == 'xls') {
				$filename = 'customer_group_price.xls';
				$writer = new Xls($this->spreadsheet);
			}

			if($filter_format == 'csv') {
				$filename = 'customer_group_price.csv';
				$writer = new Csv($this->spreadsheet);
			}

			$writer->save(DIR_UPLOAD . $filename);

			$json['download_excel'] = str_replace('&amp;', '&', $this->url->link('extension/cigroupprice/DownloadExcel', $this->module_token .'=' . $this->ci_token . '&filename='. $filename, true));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function DownloadExcel() {
		$filename = $this->request->get['filename'];
		$path = DIR_UPLOAD;

		if (!headers_sent()) {
		    if (file_exists($path . $filename)) {
				header('Content-Type: '. mime_content_type($path . $filename));
				header('Content-Disposition: attachment;filename="'. $filename .'"');
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '. filesize($path . $filename));
				header('Cache-Control: max-age=0');
				header('Accept-Ranges: bytes');

		       	readfile($path . $filename, 'rb');

		       // unlink($filename);

	     	}
     	} else {
     		exit('Error: Headers already sent out!');
     	}
 	}
}
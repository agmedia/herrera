<?php
class ControllerExtensionModuleAnchorPrice extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/anchor_price');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] === 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_anchor_price', array(
				'module_anchor_price_status' => !empty($this->request->post['module_anchor_price_status']) ? 1 : 0,
				'module_anchor_price_show_date' => !empty($this->request->post['module_anchor_price_show_date']) ? 1 : 0
			));

			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module/anchor_price', 'user_token=' . $this->session->data['user_token'], true));
		}

		$data = $this->language->all();
		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['warning_customer_price'] = $this->config->get('config_customer_price') ? $this->language->get('warning_customer_price') : '';
		$data['success'] = isset($this->session->data['success']) ? $this->session->data['success'] : '';
		$data['import_report'] = isset($this->session->data['anchor_price_import_report']) ? $this->session->data['anchor_price_import_report'] : array();

		unset($this->session->data['success'], $this->session->data['anchor_price_import_report']);

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
				'href' => $this->normaliseTemplateUrl($this->url->link('extension/module/anchor_price', 'user_token=' . $this->session->data['user_token'], true))
			)
		);

		$data['action'] = $this->normaliseTemplateUrl($this->url->link('extension/module/anchor_price', 'user_token=' . $this->session->data['user_token'], true));
		$data['import_action'] = $this->normaliseTemplateUrl($this->url->link('extension/module/anchor_price/import', 'user_token=' . $this->session->data['user_token'], true));
		$data['template_download'] = $this->normaliseTemplateUrl($this->url->link('extension/module/anchor_price/downloadTemplate', 'user_token=' . $this->session->data['user_token'], true));
		$data['cancel'] = $this->normaliseTemplateUrl($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		$data['module_anchor_price_status'] = isset($this->request->post['module_anchor_price_status']) ? (int)$this->request->post['module_anchor_price_status'] : (int)$this->config->get('module_anchor_price_status');
		$data['module_anchor_price_show_date'] = isset($this->request->post['module_anchor_price_show_date']) ? (int)$this->request->post['module_anchor_price_show_date'] : (int)$this->config->get('module_anchor_price_show_date');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/anchor_price', $data));
	}

	public function import() {
		$this->load->language('extension/module/anchor_price');

		if (($this->request->server['REQUEST_METHOD'] !== 'POST') || !$this->validate()) {
			$this->session->data['anchor_price_import_report'] = array(
				'success' => false,
				'message' => isset($this->error['warning']) ? $this->error['warning'] : $this->language->get('error_permission'),
				'errors' => array()
			);
			return $this->redirectToModule();
		}

		if (!isset($this->request->files['anchor_price_csv']) || $this->request->files['anchor_price_csv']['error'] !== UPLOAD_ERR_OK) {
			$this->setImportError($this->language->get('error_upload'));
			return $this->redirectToModule();
		}

		$file = $this->request->files['anchor_price_csv'];

		if ((int)$file['size'] <= 0 || (int)$file['size'] > 100 * 1024 * 1024) {
			$this->setImportError($this->language->get('error_file_size'));
			return $this->redirectToModule();
		}

		$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

		if (!in_array($extension, array('csv', 'txt'), true)) {
			$this->setImportError($this->language->get('error_file_type'));
			return $this->redirectToModule();
		}

		$handle = fopen($file['tmp_name'], 'rb');

		if (!$handle) {
			$this->setImportError($this->language->get('error_upload'));
			return $this->redirectToModule();
		}

		$first_line = fgets($handle);

		if ($first_line === false) {
			fclose($handle);
			$this->setImportError($this->language->get('error_empty_file'));
			return $this->redirectToModule();
		}

		$delimiter = $this->detectDelimiter($first_line);
		$headers = str_getcsv($first_line, $delimiter, '"', '\\');
		$headers = array_map(array($this, 'normaliseHeader'), $headers);
		$header_map = $this->mapHeaders($headers);

		if (!isset($header_map['anchor_price']) || !isset($header_map['reference_date']) || (!isset($header_map['product_id']) && !isset($header_map['sku']) && !isset($header_map['model']))) {
			fclose($handle);
			$this->setImportError($this->language->get('error_columns'));
			return $this->redirectToModule();
		}

		$lock_path = rtrim(DIR_CACHE, '/\\') . '/anchor_price_import.lock';
		$lock_handle = @fopen($lock_path, 'c');

		if (!$lock_handle || !flock($lock_handle, LOCK_EX | LOCK_NB)) {
			fclose($handle);

			if (is_resource($lock_handle)) {
				fclose($lock_handle);
			}

			$this->setImportError($this->language->get('error_import_locked'));
			return $this->redirectToModule();
		}

		@set_time_limit(0);

		$this->load->model('extension/module/anchor_price');
		$updated = 0;
		$cleared = 0;
		$skipped = 0;
		$line_number = 1;
		$errors = array();
		$batch = array();
		$batch_size = 500;

		try {
			while (($values = fgetcsv($handle, 0, $delimiter, '"', '\\')) !== false) {
				$line_number++;

				if ($this->isEmptyCsvRow($values)) {
					continue;
				}

				// A physically missing trailing value is not the same as an explicitly
				// empty value. Only the latter may participate in clearing a record.
				if (!array_key_exists($header_map['anchor_price'], $values) || !array_key_exists($header_map['reference_date'], $values)) {
					$skipped++;
					$this->appendImportError($errors, $line_number, $this->language->get('error_truncated_row'));
					continue;
				}

				$row = array();

				foreach ($header_map as $key => $index) {
					$row[$key] = isset($values[$index]) ? trim($values[$index]) : '';
				}

				if (isset($row['product_id']) && $row['product_id'] !== '') {
					$product_id = $this->model_extension_module_anchor_price->normaliseProductId($row['product_id']);

					if ($product_id === false) {
						$skipped++;
						$this->appendImportError($errors, $line_number, $this->language->get('error_product_id'));
						continue;
					}

					$row['product_id'] = (string)$product_id;
				}

				if ((isset($row['sku']) && utf8_strlen($row['sku']) > 64) || (isset($row['model']) && utf8_strlen($row['model']) > 64)) {
					$skipped++;
					$this->appendImportError($errors, $line_number, $this->language->get('error_identifier_length'));
					continue;
				}

				$price = $this->model_extension_module_anchor_price->normalisePrice($row['anchor_price']);
				$date = $this->model_extension_module_anchor_price->normaliseDate($row['reference_date']);

				if ($price === false) {
					$skipped++;
					$this->appendImportError($errors, $line_number, $this->language->get('error_price'));
					continue;
				}

				if ($date === false) {
					$skipped++;
					$this->appendImportError($errors, $line_number, $this->language->get('error_date'));
					continue;
				}

				if (($price === '') !== ($date === '')) {
					$skipped++;
					$this->appendImportError($errors, $line_number, $this->language->get('error_pair'));
					continue;
				}

				$batch[] = array('line' => $line_number, 'row' => $row, 'price' => $price, 'date' => $date);

				if (count($batch) >= $batch_size) {
					$this->processImportBatch($batch, $updated, $cleared, $skipped, $errors);
					$batch = array();
				}
			}

			if ($batch) {
				$this->processImportBatch($batch, $updated, $cleared, $skipped, $errors);
			}
		} finally {
			fclose($handle);
			flock($lock_handle, LOCK_UN);
			fclose($lock_handle);
		}

		$this->session->data['anchor_price_import_report'] = array(
			'success' => true,
			'message' => sprintf($this->language->get('text_import_complete'), $updated, $cleared, $skipped),
			'errors' => $errors
		);

		$this->redirectToModule();
	}

	public function downloadTemplate() {
		$this->load->language('extension/module/anchor_price');

		if (!$this->user->hasPermission('access', 'extension/module/anchor_price')) {
			$this->response->addHeader('HTTP/1.1 403 Forbidden');
			$this->response->setOutput($this->language->get('error_permission'));
			return;
		}

		$this->response->addHeader('Content-Type: text/csv; charset=UTF-8');
		$this->response->addHeader('Content-Disposition: attachment; filename="anchor-prices-template.csv"');
		$this->response->setOutput("\xEF\xBB\xBFproduct_id;sku;model;anchor_price;reference_date\r\n123;;;19,99;2026-09-10\r\n");
	}

	public function install() {
		$this->load->model('extension/module/anchor_price');
		$this->model_extension_module_anchor_price->install();
		$this->load->model('user/user_group');
		$route = 'extension/module/anchor_price';

		if (!$this->user->hasPermission('access', $route)) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', $route);
		}

		if (!$this->user->hasPermission('modify', $route)) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', $route);
		}

		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('module_anchor_price', array(
			'module_anchor_price_status' => 1,
			'module_anchor_price_show_date' => 1
		));
		$this->load->model('setting/event');
		$this->model_setting_event->deleteEventByCode('anchor_price');
		$this->model_setting_event->addEvent('anchor_price', 'admin/view/catalog/product_form/before', 'extension/module/anchor_price/eventProductForm');
		$this->model_setting_event->addEvent('anchor_price', 'admin/model/catalog/product/addProduct/after', 'extension/module/anchor_price/eventProductSave');
		$this->model_setting_event->addEvent('anchor_price', 'admin/model/catalog/product/editProduct/after', 'extension/module/anchor_price/eventProductSave');
		$this->model_setting_event->addEvent('anchor_price', 'admin/model/catalog/product/deleteProduct/after', 'extension/module/anchor_price/eventProductDelete');
		$this->model_setting_event->addEvent('anchor_price', 'catalog/view/product/*/before', 'extension/module/anchor_price/eventViewProducts');
		$this->model_setting_event->addEvent('anchor_price', 'catalog/view/extension/module/*/before', 'extension/module/anchor_price/eventViewProducts');
		$this->model_setting_event->addEvent('anchor_price', 'catalog/controller/common/header/before', 'extension/module/anchor_price/eventHeader');
	}

	public function uninstall() {
		$this->load->model('setting/event');
		$this->model_setting_event->deleteEventByCode('anchor_price');
		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('module_anchor_price');
		// Regulatory price history is deliberately preserved in product_anchor_price.
	}

	public function eventProductForm(&$route, &$data) {
		$this->load->language('extension/module/anchor_price');
		$this->load->model('extension/module/anchor_price');

		$data['entry_anchor_price'] = $this->language->get('entry_anchor_price');
		$data['entry_anchor_reference_date'] = $this->language->get('entry_anchor_reference_date');
		$data['help_anchor_price'] = $this->language->get('help_anchor_price');
		$data['help_anchor_reference_date'] = $this->language->get('help_anchor_reference_date');
		$stored = array();

		if (!empty($this->request->get['product_id'])) {
			$stored = $this->model_extension_module_anchor_price->getProductAnchorPrice((int)$this->request->get['product_id']);
		}

		$data['anchor_price'] = isset($this->request->post['anchor_price']) ? $this->request->post['anchor_price'] : (isset($stored['anchor_price']) ? $stored['anchor_price'] : '');
		$data['anchor_reference_date'] = isset($this->request->post['anchor_reference_date']) ? $this->request->post['anchor_reference_date'] : (!empty($stored['reference_date']) ? $stored['reference_date'] : '');
	}

	public function eventProductSave($route, $args, $output) {
		$product_id = 0;
		$product_data = array();

		if (strpos($route, '/addProduct') !== false) {
			$product_id = (int)$output;
			$product_data = isset($args[0]) && is_array($args[0]) ? $args[0] : array();
		} elseif (isset($args[0], $args[1]) && is_array($args[1])) {
			$product_id = (int)$args[0];
			$product_data = $args[1];
		}

		if ($product_id && (array_key_exists('anchor_price', $product_data) || array_key_exists('anchor_reference_date', $product_data))) {
			$this->load->model('extension/module/anchor_price');
			$this->model_extension_module_anchor_price->setProductAnchorPrice(
				$product_id,
				isset($product_data['anchor_price']) ? $product_data['anchor_price'] : '',
				isset($product_data['anchor_reference_date']) ? $product_data['anchor_reference_date'] : ''
			);
		}
	}

	public function eventProductDelete($route, $args, $output) {
		if (!empty($args[0])) {
			$this->load->model('extension/module/anchor_price');
			$this->model_extension_module_anchor_price->deleteProductAnchorPrice((int)$args[0]);
		}
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/anchor_price')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	private function redirectToModule() {
		$this->response->redirect($this->url->link('extension/module/anchor_price', 'user_token=' . $this->session->data['user_token'], true));
	}

	private function normaliseTemplateUrl($url) {
		return str_replace('&amp;', '&', (string)$url);
	}

	private function setImportError($message) {
		$this->session->data['anchor_price_import_report'] = array('success' => false, 'message' => $message, 'errors' => array());
	}

	private function appendImportError(&$errors, $line, $message) {
		if (count($errors) < 100) {
			$errors[] = sprintf($this->language->get('text_import_error_line'), $line, $message);
		}
	}

	private function processImportBatch(array $batch, &$updated, &$cleared, &$skipped, array &$errors) {
		$rows = array();

		foreach ($batch as $index => $item) {
			$rows[$index] = $item['row'];
		}

		$product_ids = $this->model_extension_module_anchor_price->findProductIds($rows);
		$changes = array();

		foreach ($batch as $index => $item) {
			$product_id = isset($product_ids[$index]) ? $product_ids[$index] : 0;

			if ($product_id === -2) {
				$skipped++;
				$this->appendImportError($errors, $item['line'], $this->language->get('error_product_id'));
				continue;
			}

			if ($product_id === -1) {
				$skipped++;
				$this->appendImportError($errors, $item['line'], $this->language->get('error_ambiguous_product'));
				continue;
			}

			if (!$product_id) {
				$skipped++;
				$this->appendImportError($errors, $item['line'], $this->language->get('error_product_not_found'));
				continue;
			}

			$changes[] = array(
				'line' => $item['line'],
				'product_id' => $product_id,
				'anchor_price' => $item['price'],
				'reference_date' => $item['date']
			);
		}

		if (!$changes) {
			return;
		}

		if (!$this->model_extension_module_anchor_price->setProductAnchorPrices($changes)) {
			foreach ($changes as $change) {
				$skipped++;
				$this->appendImportError($errors, $change['line'], $this->language->get('error_row'));
			}

			return;
		}

		foreach ($changes as $change) {
			if ($change['anchor_price'] === '' && $change['reference_date'] === '') {
				$cleared++;
			} else {
				$updated++;
			}
		}
	}

	private function detectDelimiter($line) {
		$counts = array(';' => substr_count($line, ';'), ',' => substr_count($line, ','), "\t" => substr_count($line, "\t"));
		arsort($counts);

		return (string)key($counts);
	}

	public function normaliseHeader($header) {
		$header = preg_replace('/^\xEF\xBB\xBF/', '', trim((string)$header));
		$header = strtolower($header);
		$header = strtr($header, array('č' => 'c', 'ć' => 'c', 'ž' => 'z', 'š' => 's', 'đ' => 'd'));
		return preg_replace('/[^a-z0-9]+/', '_', trim($header, " \t\n\r\0\x0B_"));
	}

	private function mapHeaders(array $headers) {
		$aliases = array(
			'product_id' => array('product_id', 'id', 'id_proizvoda'),
			'sku' => array('sku'),
			'model' => array('model', 'sifra', 'sifra_proizvoda'),
			'anchor_price' => array('anchor_price', 'sidrena_cijena', 'referentna_cijena'),
			'reference_date' => array('reference_date', 'referentni_datum', 'datum_sidrene_cijene')
		);
		$map = array();

		foreach ($aliases as $key => $names) {
			foreach ($names as $name) {
				$index = array_search($name, $headers, true);
				if ($index !== false) {
					$map[$key] = $index;
					break;
				}
			}
		}

		return $map;
	}

	private function isEmptyCsvRow(array $row) {
		foreach ($row as $value) {
			if (trim((string)$value) !== '') {
				return false;
			}
		}

		return true;
	}
}

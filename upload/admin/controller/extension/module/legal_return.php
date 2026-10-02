<?php
class ControllerExtensionModuleLegalReturn extends Controller {
	private $error = array();
	private $statuses = array('new', 'processing', 'approved', 'rejected', 'closed');

	public function index() {
		$data = $this->load->language('extension/module/legal_return');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateSettings()) {
			$settings = array(
				'module_legal_return_status' => !empty($this->request->post['module_legal_return_status']) ? 1 : 0,
				'module_legal_return_header_status' => !empty($this->request->post['module_legal_return_header_status']) ? 1 : 0,
				'module_legal_return_email' => trim($this->request->post['module_legal_return_email'])
			);
			$this->model_setting_setting->editSetting('module_legal_return', $settings);
			$this->session->data['success'] = $this->language->get('text_success_settings');
			$this->response->redirect($this->url->link('extension/module/legal_return', 'user_token=' . $this->session->data['user_token'], true));
		}

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['error_email'] = isset($this->error['email']) ? $this->error['email'] : '';
		$data['success'] = isset($this->session->data['success']) ? $this->session->data['success'] : '';
		unset($this->session->data['success']);

		$data['breadcrumbs'] = array(
			array('text' => $this->language->get('text_home'), 'href' => $this->viewUrl($this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true))),
			array('text' => $this->language->get('text_extension'), 'href' => $this->viewUrl($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true))),
			array('text' => $this->language->get('heading_title'), 'href' => $this->viewUrl($this->url->link('extension/module/legal_return', 'user_token=' . $this->session->data['user_token'], true)))
		);

		$data['action'] = $this->viewUrl($this->url->link('extension/module/legal_return', 'user_token=' . $this->session->data['user_token'], true));
		$data['cancel'] = $this->viewUrl($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		$data['requests_url'] = $this->viewUrl($this->url->link('extension/module/legal_return/requests', 'user_token=' . $this->session->data['user_token'], true));

		$defaults = array(
			'module_legal_return_status' => 0,
			'module_legal_return_header_status' => 0,
			'module_legal_return_email' => $this->config->get('config_email')
		);

		foreach ($defaults as $key => $default) {
			$data[$key] = isset($this->request->post[$key]) && is_scalar($this->request->post[$key]) ? (string)$this->request->post[$key] : (($this->config->get($key) !== null) ? $this->config->get($key) : $default);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/legal_return', $data));
	}

	public function requests() {
		$data = $this->load->language('extension/module/legal_return');
		$this->document->setTitle($this->language->get('text_requests'));
		$this->load->model('extension/module/legal_return');

		$filter_status = isset($this->request->get['filter_status']) && is_string($this->request->get['filter_status']) && in_array($this->request->get['filter_status'], $this->statuses, true) ? $this->request->get['filter_status'] : '';
		$filter_search = isset($this->request->get['filter_search']) && is_string($this->request->get['filter_search']) ? $this->decodeInput($this->request->get['filter_search']) : '';
		$sort = isset($this->request->get['sort']) ? $this->request->get['sort'] : 'date_added';
		$order = isset($this->request->get['order']) && $this->request->get['order'] === 'ASC' ? 'ASC' : 'DESC';
		$page = isset($this->request->get['page']) && is_scalar($this->request->get['page']) ? max(1, (int)$this->request->get['page']) : 1;
		$limit = (int)$this->config->get('config_limit_admin') ?: 20;

		$filter_data = array('filter_status' => $filter_status, 'filter_search' => $filter_search, 'sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $limit, 'limit' => $limit);
		$total = $this->model_extension_module_legal_return->getTotalRequests($filter_data);
		$results = $this->model_extension_module_legal_return->getRequests($filter_data);
		$data['requests'] = array();

		foreach ($results as $result) {
			$data['requests'][] = array(
				'legal_return_id' => (int)$result['legal_return_id'],
				'order_id' => (int)$result['order_id'],
				'customer' => $result['firstname'] . ' ' . $result['lastname'],
				'email' => $result['email'],
				'request_type' => $this->typeLabel($result['request_type']),
				'status' => $this->statusLabel($result['status']),
				'date_added' => $result['date_added'],
				'view' => $this->viewUrl($this->url->link('extension/module/legal_return/info', 'user_token=' . $this->session->data['user_token'] . '&legal_return_id=' . (int)$result['legal_return_id'], true))
			);
		}

		$url = '&filter_status=' . urlencode($filter_status) . '&filter_search=' . urlencode($filter_search);
		$data['breadcrumbs'] = array(
			array('text' => $this->language->get('text_home'), 'href' => $this->viewUrl($this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true))),
			array('text' => $this->language->get('heading_title'), 'href' => $this->viewUrl($this->url->link('extension/module/legal_return', 'user_token=' . $this->session->data['user_token'], true))),
			array('text' => $this->language->get('text_requests'), 'href' => $this->viewUrl($this->url->link('extension/module/legal_return/requests', 'user_token=' . $this->session->data['user_token'], true)))
		);
		$data['filter_action'] = $this->viewUrl($this->url->link('extension/module/legal_return/requests', 'user_token=' . $this->session->data['user_token'], true));
		$data['export_url'] = $this->viewUrl($this->url->link('extension/module/legal_return/export', 'user_token=' . $this->session->data['user_token'] . $url, true));
		$data['settings_url'] = $this->viewUrl($this->url->link('extension/module/legal_return', 'user_token=' . $this->session->data['user_token'], true));
		$data['filter_status'] = $filter_status;
		$data['filter_search'] = $filter_search;
		$data['statuses'] = $this->statusOptions();
		$data['user_token'] = $this->session->data['user_token'];

		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('extension/module/legal_return/requests', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), $total ? (($page - 1) * $limit) + 1 : 0, min($page * $limit, $total), $total, ceil($total / $limit));
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/legal_return_list', $data));
	}

	public function info() {
		$data = $this->load->language('extension/module/legal_return');
		$this->document->setTitle($this->language->get('text_request_details'));
		$this->load->model('extension/module/legal_return');
		$legal_return_id = isset($this->request->get['legal_return_id']) && is_scalar($this->request->get['legal_return_id']) ? (int)$this->request->get['legal_return_id'] : 0;
		$request_info = $this->model_extension_module_legal_return->getRequest($legal_return_id);

		if (!$request_info) {
			return new Action('error/not_found');
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateModify()) {
			$status = isset($this->request->post['status']) && is_string($this->request->post['status']) && in_array($this->request->post['status'], $this->statuses, true) ? $this->request->post['status'] : 'new';
			$admin_note = isset($this->request->post['admin_note']) && is_string($this->request->post['admin_note']) ? $this->decodeInput($this->request->post['admin_note']) : '';
			$this->model_extension_module_legal_return->updateRequest($legal_return_id, $status, $admin_note);
			$this->session->data['success'] = $this->language->get('text_success_request');
			$this->response->redirect($this->url->link('extension/module/legal_return/info', 'user_token=' . $this->session->data['user_token'] . '&legal_return_id=' . $legal_return_id, true));
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['request'] = $request_info;
		$data['request']['request_type_label'] = $this->typeLabel($request_info['request_type']);
		$data['statuses'] = $this->statusOptions();
		$data['action'] = $this->viewUrl($this->url->link('extension/module/legal_return/info', 'user_token=' . $this->session->data['user_token'] . '&legal_return_id=' . $legal_return_id, true));
		$data['cancel'] = $this->viewUrl($this->url->link('extension/module/legal_return/requests', 'user_token=' . $this->session->data['user_token'], true));
		$data['breadcrumbs'] = array(
			array('text' => $this->language->get('text_home'), 'href' => $this->viewUrl($this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true))),
			array('text' => $this->language->get('text_requests'), 'href' => $data['cancel']),
			array('text' => '#' . $legal_return_id, 'href' => $data['action'])
		);
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/legal_return_info', $data));
	}

	public function export() {
		if (!$this->user->hasPermission('access', 'extension/module/legal_return')) {
			$this->response->redirect($this->url->link('error/permission', 'user_token=' . $this->session->data['user_token'], true));
		}

		$this->load->model('extension/module/legal_return');
		$filter_data = array(
			'filter_status' => isset($this->request->get['filter_status']) && is_string($this->request->get['filter_status']) && in_array($this->request->get['filter_status'], $this->statuses, true) ? $this->request->get['filter_status'] : '',
			'filter_search' => isset($this->request->get['filter_search']) && is_string($this->request->get['filter_search']) ? $this->decodeInput($this->request->get['filter_search']) : '',
			'sort' => 'legal_return_id',
			'order' => 'DESC'
		);
		@set_time_limit(0);
		$stream = fopen('php://output', 'wb');

		if (!$stream) {
			$this->response->addHeader('HTTP/1.1 500 Internal Server Error');
			$this->response->setOutput('CSV export could not be opened.');
			return;
		}

		header('Content-Type: text/csv; charset=UTF-8');
		header('Content-Disposition: attachment; filename="legal-returns-' . date('Y-m-d-His') . '.csv"');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Pragma: no-cache');
		header('X-Content-Type-Options: nosniff');
		fwrite($stream, "\xEF\xBB\xBF");
		fputcsv($stream, array('ID', 'Order ID', 'Type', 'First name', 'Last name', 'Email', 'Telephone', 'Address', 'Received date', 'Products', 'Reason', 'IBAN', 'Status', 'Admin note', 'IP', 'Submitted at', 'Updated at'), ',', '"', '\\');
		$before_id = 0;
		$batch_size = 500;

		do {
			$rows = $this->model_extension_module_legal_return->getRequestsForExport($filter_data, $before_id, $batch_size);

			foreach ($rows as $row) {
				fputcsv($stream, array(
					$row['legal_return_id'], $row['order_id'], $row['request_type'], $this->csvSafe($row['firstname']), $this->csvSafe($row['lastname']),
					$this->csvSafe($row['email']), $this->csvSafe($row['telephone']), $this->csvSafe($row['address']), $row['received_date'],
					$this->csvSafe($row['product_details']), $this->csvSafe($row['reason']), $this->csvSafe($row['iban']), $row['status'],
					$this->csvSafe($row['admin_note']), $row['ip'], $row['date_added'], $row['date_modified']
				), ',', '"', '\\');
				$before_id = (int)$row['legal_return_id'];
			}

			fflush($stream);
		} while (count($rows) === $batch_size && !connection_aborted());

		fclose($stream);
		exit;
	}

	public function install() {
		$this->load->model('extension/module/legal_return');
		$this->model_extension_module_legal_return->install();
		$this->load->model('user/user_group');
		if (!$this->user->hasPermission('access', 'extension/module/legal_return')) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/legal_return');
		}
		if (!$this->user->hasPermission('modify', 'extension/module/legal_return')) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/legal_return');
		}
		$this->load->model('setting/setting');
		if ($this->config->get('module_legal_return_status') === null) {
			$this->model_setting_setting->editSetting('module_legal_return', array('module_legal_return_status' => 1, 'module_legal_return_header_status' => 1, 'module_legal_return_email' => $this->config->get('config_email')));
		}
	}

	public function uninstall() {
		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('module_legal_return');
		// Requests are deliberately retained as business/legal records.
	}

	private function validateSettings() {
		if (!$this->user->hasPermission('modify', 'extension/module/legal_return')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (empty($this->request->post['module_legal_return_email']) || !is_string($this->request->post['module_legal_return_email']) || !filter_var($this->request->post['module_legal_return_email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}
		return !$this->error;
	}

	private function validateModify() {
		if (!$this->user->hasPermission('modify', 'extension/module/legal_return')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}

	private function statusOptions() {
		$options = array();
		foreach ($this->statuses as $status) {
			$options[$status] = $this->statusLabel($status);
		}
		return $options;
	}

	private function statusLabel($status) {
		$key = 'text_status_' . $status;
		$label = $this->language->get($key);
		return $label === $key ? $status : $label;
	}

	private function typeLabel($type) {
		return $type === 'withdrawal_14_days' ? $this->language->get('text_type_withdrawal') : $this->language->get('text_type_return');
	}

	private function viewUrl($url) {
		return str_replace('&amp;', '&', $url);
	}

	private function decodeInput($value) {
		return html_entity_decode(trim((string)$value), ENT_QUOTES, 'UTF-8');
	}

	private function csvSafe($value) {
		$value = (string)$value;
		return preg_match('/^[\x00-\x20]*[=+\-@]/', $value) ? "'" . $value : $value;
	}
}

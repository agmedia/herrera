<?php
class ControllerExtensionModuleLegalReturn extends Controller {
	private $error = array();

	public function index() {
		return '';
	}

	// Kept as an empty compatibility endpoint for previously installed OCMOD XML.
	public function header() {
		return '';
	}

	public function footer() {
		if (!$this->isEnabled() || !$this->settingEnabled('module_legal_return_header_status', true)) {
			return array();
		}

		$this->load->language('extension/module/legal_return');

		return array(
			'text' => $this->language->get('text_header_link'),
			'href' => $this->viewUrl($this->url->link('extension/module/legal_return/form', '', true))
		);
	}

	public function form() {
		if (!$this->isEnabled()) {
			return new Action('error/not_found');
		}

		$data = $this->load->language('extension/module/legal_return');
		$this->load->model('extension/module/legal_return');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->setDescription($this->language->get('text_meta_description'));

		if (isset($this->request->get['edit'])) {
			unset($this->session->data['legal_return_draft'], $this->session->data['legal_return_confirm_token']);
			$this->response->redirect($this->url->link('extension/module/legal_return/form', '', true));
		}

		$stage = isset($this->request->post['stage']) ? $this->request->post['stage'] : '';

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $stage === 'review' && $this->validate()) {
			$this->session->data['legal_return_draft'] = $this->cleanRequest($this->request->post);
			$this->session->data['legal_return_confirm_token'] = token(32);
			$this->response->redirect($this->url->link('extension/module/legal_return/form', 'review=1', true));
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $stage === 'confirm' && $this->validateConfirmation()) {
			$request = $this->session->data['legal_return_draft'];
			$request['ip'] = isset($this->request->server['REMOTE_ADDR']) ? $this->request->server['REMOTE_ADDR'] : '';
			$request['submitted_at'] = date('Y-m-d H:i:s');
			$request['submitted_at_display'] = date('Y-m-d H:i:s P') . ' (' . date_default_timezone_get() . ')';

			$request_id = $this->model_extension_module_legal_return->addRequest($request);

			if (!$request_id) {
				$this->error['warning'] = $this->language->get('error_rate_limit');
			} else {
				$delivery = $this->sendNotifications($request_id, $request);
				$mail_sent = $delivery['customer'];

				unset($this->session->data['legal_return_token'], $this->session->data['legal_return_draft'], $this->session->data['legal_return_confirm_token']);
				$this->session->data['legal_return_reference'] = $request_id;
				$this->session->data['legal_return_submitted_at'] = $request['submitted_at_display'];
				$this->session->data['legal_return_mail_sent'] = $mail_sent;
				$this->response->redirect($this->url->link('extension/module/legal_return/success', '', true));
			}
		}

		$data['breadcrumbs'] = array(
			array('text' => $this->language->get('text_home'), 'href' => $this->viewUrl($this->url->link('common/home'))),
			array('text' => $this->language->get('heading_title'), 'href' => $this->viewUrl($this->url->link('extension/module/legal_return/form', '', true)))
		);

		$review = (isset($this->request->get['review']) || $stage === 'confirm') && !empty($this->session->data['legal_return_draft']);
		$source = $review ? $this->session->data['legal_return_draft'] : $this->request->post;
		$fields = array('order_id', 'request_type', 'firstname', 'lastname', 'email', 'telephone', 'address', 'received_date', 'product_details', 'reason', 'iban');

		foreach ($fields as $field) {
			if (isset($source[$field]) && is_scalar($source[$field])) {
				// The draft was already decoded by cleanRequest(). Incoming POST data
				// still carries OpenCart Request's single htmlspecialchars() layer.
				$data[$field] = $review ? (string)$source[$field] : $this->decodeInput($source[$field]);
			} else {
				$data[$field] = '';
			}
		}

		if (!$review && $this->customer->isLogged() && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$this->load->model('account/customer');
			$customer = $this->model_account_customer->getCustomer($this->customer->getId());

			if ($customer) {
				$data['firstname'] = $customer['firstname'];
				$data['lastname'] = $customer['lastname'];
				$data['email'] = $customer['email'];
				$data['telephone'] = $customer['telephone'];
			}
		}

		if (empty($this->session->data['legal_return_token'])) {
			$this->session->data['legal_return_token'] = token(32);
		}

		$data['review'] = $review;
		$data['form_token'] = $this->session->data['legal_return_token'];
		$data['confirm_token'] = $review && !empty($this->session->data['legal_return_confirm_token']) ? $this->session->data['legal_return_confirm_token'] : '';
		$data['edit_url'] = $this->viewUrl($this->url->link('extension/module/legal_return/form', 'edit=1', true));
		$data['action'] = $this->viewUrl($this->url->link('extension/module/legal_return/form', '', true));
		$data['eu_withdrawal_url'] = 'https://europa.eu/youreurope/citizens/consumers/shopping/returns/index_hr.htm';
		$data['eu_guarantee_url'] = 'https://europa.eu/youreurope/citizens/consumers/shopping/guarantees/index_hr.htm';
		$data['merchant_email'] = $this->merchantEmail();
		$data['errors'] = $this->error;
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('extension/module/legal_return_form', $data));
	}

	public function success() {
		if (!$this->isEnabled() || empty($this->session->data['legal_return_reference'])) {
			$this->response->redirect($this->url->link('extension/module/legal_return/form', '', true));
		}

		$data = $this->load->language('extension/module/legal_return');
		$this->document->setTitle($this->language->get('text_success_heading'));

		$data['reference'] = (int)$this->session->data['legal_return_reference'];
		$data['submitted_at'] = !empty($this->session->data['legal_return_submitted_at']) ? $this->session->data['legal_return_submitted_at'] : '';
		$data['mail_sent'] = !empty($this->session->data['legal_return_mail_sent']);
		unset($this->session->data['legal_return_reference'], $this->session->data['legal_return_submitted_at'], $this->session->data['legal_return_mail_sent']);

		$data['breadcrumbs'] = array(
			array('text' => $this->language->get('text_home'), 'href' => $this->viewUrl($this->url->link('common/home'))),
			array('text' => $this->language->get('heading_title'), 'href' => $this->viewUrl($this->url->link('extension/module/legal_return/form', '', true)))
		);
		$data['continue'] = $this->viewUrl($this->url->link('common/home'));
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('extension/module/legal_return_success', $data));
	}

	private function validate() {
		if (empty($this->session->data['legal_return_token']) || empty($this->request->post['form_token']) || !is_string($this->request->post['form_token']) || !hash_equals($this->session->data['legal_return_token'], $this->request->post['form_token'])) {
			$this->error['warning'] = $this->language->get('error_session');
		}

		if (!empty($this->request->post['website'])) {
			$this->error['warning'] = $this->language->get('error_session');
		}

		$order_id = $this->postString('order_id');
		if (!preg_match('/^[1-9][0-9]{0,9}$/', $order_id) || (int)$order_id > 2147483647) {
			$this->error['order_id'] = $this->language->get('error_order_id');
		}

		if (empty($this->request->post['request_type']) || !is_string($this->request->post['request_type']) || !in_array($this->request->post['request_type'], array('withdrawal_14_days', 'return_other'), true)) {
			$this->error['request_type'] = $this->language->get('error_request_type');
		}

		foreach (array('firstname', 'lastname') as $field) {
			$value = $this->postString($field);
			if (utf8_strlen($value) < 2 || utf8_strlen($value) > 64) {
				$this->error[$field] = $this->language->get('error_' . $field);
			}
		}

		$email = $this->postString('email');
		if (utf8_strlen($email) > 96 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if (!isset($this->error['order_id'], $this->error['email'])) {
			$ip = isset($this->request->server['REMOTE_ADDR']) ? (string)$this->request->server['REMOTE_ADDR'] : '';

			if (!$this->model_extension_module_legal_return->consumeVerificationAttempt($ip)) {
				$this->error['warning'] = $this->language->get('error_rate_limit');
			} elseif (!$this->model_extension_module_legal_return->orderMatches($order_id, $email)) {
				$this->error['warning'] = $this->language->get('error_order_match');
			}
		}

		$address = $this->postString('address');
		if (utf8_strlen($address) < 5 || utf8_strlen($address) > 1000) {
			$this->error['address'] = $this->language->get('error_address');
		}

		$received_date = $this->postString('received_date');
		if (!$received_date || !$this->validDate($received_date)) {
			$this->error['received_date'] = $this->language->get('error_received_date');
		}

		$product_details = $this->postString('product_details');
		if (utf8_strlen($product_details) < 3 || utf8_strlen($product_details) > 4000) {
			$this->error['product_details'] = $this->language->get('error_product_details');
		}

		if (!isset($this->request->post['confirmation']) || !is_scalar($this->request->post['confirmation']) || (string)$this->request->post['confirmation'] !== '1') {
			$this->error['confirmation'] = $this->language->get('error_confirmation');
		}

		if (utf8_strlen($this->postString('telephone')) > 32) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		if (utf8_strlen($this->postString('reason')) > 4000) {
			$this->error['reason'] = $this->language->get('error_reason');
		}

		if (utf8_strlen($this->postString('iban')) > 64) {
			$this->error['iban'] = $this->language->get('error_iban');
		}

		return !$this->error;
	}

	private function validateConfirmation() {
		if (empty($this->session->data['legal_return_draft']) || empty($this->session->data['legal_return_confirm_token']) || empty($this->request->post['confirm_token']) || !is_string($this->request->post['confirm_token']) || !hash_equals($this->session->data['legal_return_confirm_token'], $this->request->post['confirm_token'])) {
			$this->error['warning'] = $this->language->get('error_confirmation_session');
		}

		if (!$this->error) {
			$draft = $this->session->data['legal_return_draft'];

			if (!$this->model_extension_module_legal_return->orderMatches($draft['order_id'], $draft['email'])) {
				$this->error['warning'] = $this->language->get('error_order_match');
			}
		}

		return !$this->error;
	}

	private function validDate($value) {
		$date = DateTime::createFromFormat('Y-m-d', $value);
		return $date && $date->format('Y-m-d') === $value;
	}

	private function cleanRequest($post) {
		$clean = array();
		$clean['order_id'] = (int)$post['order_id'];
		$clean['request_type'] = in_array($post['request_type'], array('withdrawal_14_days', 'return_other'), true) ? $post['request_type'] : 'return_other';

		foreach (array('firstname', 'lastname', 'email', 'telephone', 'address', 'received_date', 'product_details', 'reason', 'iban') as $field) {
			$clean[$field] = isset($post[$field]) && is_string($post[$field]) ? $this->decodeInput($post[$field]) : '';
		}

		return $clean;
	}

	private function postString($key) {
		return isset($this->request->post[$key]) && is_string($this->request->post[$key]) ? $this->decodeInput($this->request->post[$key]) : '';
	}

	private function decodeInput($value) {
		return html_entity_decode(trim((string)$value), ENT_QUOTES, 'UTF-8');
	}

	private function viewUrl($url) {
		return str_replace('&amp;', '&', $url);
	}

	private function merchantEmail() {
		$email = trim((string)$this->config->get('module_legal_return_email'));

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = trim((string)$this->config->get('config_email'));
		}

		return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : '';
	}

	private function sendNotifications($request_id, $request) {
		$data = array_merge($this->load->language('extension/module/legal_return'), $request);
		$data['request_id'] = (int)$request_id;
		$data['store_name'] = $this->config->get('config_name');
		$data['request_type_label'] = $request['request_type'] == 'withdrawal_14_days' ? $this->language->get('text_type_withdrawal') : $this->language->get('text_type_return');
		$data['submitted_at'] = $request['submitted_at_display'];
		$data['text_mail_intro_customer'] = $this->language->get('text_mail_intro_customer');
		$data['text_mail_intro_admin'] = $this->language->get('text_mail_intro_admin');
		$data['text_mail_reference'] = $this->language->get('text_mail_reference');
		$data['text_mail_notice'] = $this->language->get('text_mail_notice');
		$data['text_mail_admin_notice'] = $this->language->get('text_mail_admin_notice');
		$data['text_mail_submitted_at'] = $this->language->get('text_mail_submitted_at');
		$data['is_admin'] = false;

		$result = array('customer' => false, 'admin' => false);

		try {
			$customer_html = $this->load->view('extension/module/legal_return_mail', $data);
			$this->sendMail($request['email'], sprintf($this->language->get('text_mail_subject_customer'), $request_id), $customer_html);
			$result['customer'] = true;
		} catch (Exception $exception) {
			$this->log->write('Legal Return customer mail error for request #' . (int)$request_id . ': ' . $exception->getMessage());
		}

		$admin_email = trim((string)$this->config->get('module_legal_return_email'));
		if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
			$admin_email = $this->config->get('config_email');
		}

		$data['is_admin'] = true;

		try {
			$admin_html = $this->load->view('extension/module/legal_return_mail', $data);
			$this->sendMail($admin_email, sprintf($this->language->get('text_mail_subject_admin'), $request_id, $request['order_id']), $admin_html);
			$result['admin'] = true;
		} catch (Exception $exception) {
			$this->log->write('Legal Return administrator mail error for request #' . (int)$request_id . ': ' . $exception->getMessage());
		}

		return $result;
	}

	private function sendMail($to, $subject, $html) {
		$mail = new Mail($this->config->get('config_mail_engine'));
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
		$mail->setTo($to);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml($html);
		$mail->send();
	}

	private function isEnabled() {
		return $this->settingEnabled('module_legal_return_status', false);
	}

	private function settingEnabled($key, $default) {
		$value = $this->config->get($key);
		return ($value === null || $value === '') ? (bool)$default : (bool)$value;
	}
}

<?php
class ControllerExtensionOrdertracking extends Controller {
	public function index() {
		$this->load->language('extension/order_tracking');

		$this->document->setTitle($this->language->get('heading_title'));

		$url                 = '';
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_order_tracking'),
			'href' => $this->url->link('extension/order_tracking', '', true)
		);

		$data['column_left']    = $this->load->controller('common/column_left');
		$data['column_right']   = $this->load->controller('common/column_right');
		$data['content_top']    = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer']         = $this->load->controller('common/footer');
		$data['header']         = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('extension/order_tracking', $data));
	}

	public function ordertrack() {
		$json = array();
		$this->load->language('extension/order_tracking');
		$this->load->model('extension/order_tracking');
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

			 if(empty($this->request->post['email']) || empty($this->request->post['order_id'])){

				$json['error_email']=$this->language->get('warning_email');
			 }
			if(!empty($this->request->post['email']) && !empty($this->request->post['order_id'])){

				$orderinfo = $this->model_extension_order_tracking->getOrderinfo($this->request->post);
				if(empty($orderinfo['order_id'])){
					$json['error_email']=$this->language->get('warning_info');
				}
			 }
			if (empty($json)) {
				
				

                $order_status_id=$orderinfo['order_status_id'];
				$tracking_status = $this->model_extension_order_tracking->getOrderstatus($order_status_id);

				$json['orderid']        = $orderinfo['order_id'];
				$json['trackingstatus'] = $tracking_status['name'];
				$json['trackingnumber'] ='';
				$json['shipingcompany'] ='';
										
				$json['success']        = $this->language->get('track_message');
				$tracking_info = $this->model_extension_order_tracking->getordertracking($this->request->post);
				if (!empty($tracking_info['tracking_number'])) {
					$tracking_number      = $tracking_info['tracking_number'];
					$shipingcomanies_info = $this->config->get('module_tmd_ordertracking_shipingcomanie');

					$shipingcomanies = array();
					if ($shipingcomanies_info) {
						foreach ($shipingcomanies_info as $info) {
							$shipingcomanies[$info['name']] = $info['url'];

						}
					}
					$json['trackorder'] = '';
					$trackorder         = '';
					if (isset($shipingcomanies[$tracking_info['shipingcompany']])) {

						$json['trackorder'] = $shipingcomanies[$tracking_info['shipingcompany']].$tracking_info['tracking_number'];

						$trackorder = $shipingcomanies[$tracking_info['shipingcompany']].$tracking_info['tracking_number'];

						$url                = $shipingcomanies[$tracking_info['shipingcompany']];
						$json['trackorder'] = str_replace('{tracking_number}', $tracking_info['tracking_number'], $url);
						$trackorder         = str_replace('{tracking_number}', $tracking_info['tracking_number'], $url);
					}

					$json['trackingnumber'] = $tracking_info['tracking_number'];
					
					$json['shipingcompany'] = $tracking_info['shipingcompany'];
					


					
				} 
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

	}

}

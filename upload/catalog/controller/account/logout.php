<?php

use Agmedia\Api\Models\OC_OrderManagerSales;

class ControllerAccountLogout extends Controller {
	public function index() {
		if ($this->customer->isLogged()) {
            // fj.agmedia.hr
            if (isset($this->session->data['order_from_manager']) && isset($this->session->data['order_from_manager']['oms_id'])) {
                $id = $this->session->data['order_from_manager']['oms_id'];
                $has_order = OC_OrderManagerSales::query()->where('id', $id)->first();
                $update_data = [
                    'start' => date('Y-m-d H:i:s'),
                    'user_id' => $this->session->data['user_id'],
                    'customer_id' => $this->session->data['customer_id'],
                ];

                if ($has_order) {
                    OC_OrderManagerSales::query()->where('id', $id)->update($update_data);
                } else {
                    $id = OC_OrderManagerSales::query()->insert($update_data);
                }

                $order_id = 0;
                $total = 0;
                if (isset($this->session->data['order_id']) && $this->session->data['order_id']) {
                    $order_id = $this->session->data['order_id'];
                    $total = \Agmedia\Models\Order\Order::query()->where('order_id', $order_id)->first()->total;
                }

                OC_OrderManagerSales::query()->where('id', $id)->update([
                    'end' => date('Y-m-d H:i:s'),
                    'napomena' => $total ? 'Odobrenje narudžbe za ' . $total : '',
                    'order_id' => $order_id,
                    'date_modified' => date('Y-m-d H:i:s'),
                ]);

                unset($this->session->data['order_from_manager']);
            }

			$this->customer->logout();

			unset($this->session->data['shipping_address']);
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_address']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);

			$this->response->redirect($this->url->link('account/logout', '', true));
		}

		$this->load->language('account/logout');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_logout'),
			'href' => $this->url->link('account/logout', '', true)
		);

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/success', $data));
	}
}

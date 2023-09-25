<?php
class ControllerExtensionPurchased extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('extension/purchased', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->load->language('extension/purchased');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purchased', $url, true)
		);

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['products'] = array();

		$this->load->model('extension/purchased');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		$purchased_total = $this->model_extension_purchased->getTotalPurchased();
		$counter = 0;
		foreach ($purchased_total as $total) {
			$counter += count(explode(',',$total['counter'],0));
		}
		$total = $counter;
		
		$results = $this->model_extension_purchased->getPurchased(($page - 1) * 10, 10);

		foreach ($results as $result) {
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image_product = $this->model_tool_image->resize($result['image'], 120, 120);
			} else {
				$image_product = $this->model_tool_image->resize('no_image.jpg', 120, 120);
			}
			
			$option_data = array();
			$options = $this->model_extension_purchased->getOrderOptions($result['order_product_id']);

			foreach ($options as $option) {
				if ($option['type'] != 'textarea' or $option['type'] != 'file' or $option['type'] != 'date' or $option['type'] != 'datetime' or $option['type'] != 'time') {
					$option_data[] = array(
						'name'  => $option['name'],
						'value' => $option['value'],
						'type'  => $option['type']
					);
				}
			}

			$product_info = $this->model_catalog_product->getProduct($result['product_id']);
            $svenarudzbe = strip_tags($result['product_order_id']);
            $svenarudzbe = str_replace('#', '',  $svenarudzbe);

            $svenarudzbe= substr($svenarudzbe,0,2);

            $svenarudzbe = $this->db->query("SELECT date_added FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$svenarudzbe . "'");



			if ($product_info) {
				$url_product = $this->url->link('product/product', '&product_id=' . $result['product_id'], true);
			} else {
				$url_product = '';
			}


			$data['products'][] = array(
				'product_id' 	=> $result['product_id'],
				'order_id' 		=> $result['product_order_id'],
				'image'      	=> $image_product,
				'model'    		=> $result['model'],
				'name'     		=> $result['name'],
                'date_added'     		=>  $svenarudzbe->row["date_added"],
				'url_product'  	=> $url_product,
				'option'   		=> $option_data,
				'quantity' 		=> $result['quantity'],
				'total'      	=> $this->currency->format($result['product_total'], $this->session->data['currency']),
               'return'   => $this->url->link('account/return/add', 'order_id=' . $result['order_id'] . '&product_id=' . $result['product_id'], true)
			);
		}
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('extension/purchased', 'page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($total - 10)) ? $total : ((($page - 1) * 10) + 10), $total, ceil($total / 10));

		$data['continue'] = $this->url->link('account/account', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('extension/purchased', $data));
	}
}
<?php
class ControllerExtensionModuleAnchorPrice extends Controller {
	public function index() {
		return '';
	}

	public function eventHeader(&$route, &$data) {
		if ($this->config->get('module_anchor_price_status') && $this->isDefaultCustomerGroup()) {
			$this->document->addStyle('catalog/view/javascript/anchor_price/anchor_price.css');
		}
	}

	public function eventViewProducts(&$route, &$data) {
		if (!$this->config->get('module_anchor_price_status') || !$this->isDefaultCustomerGroup() || !is_array($data)) {
			return;
		}

		$product_ids = array();
		$this->collectProductIds($data, $product_ids);

		if (!$product_ids) {
			return;
		}

		$this->load->language('extension/module/anchor_price');
		$this->load->model('extension/module/anchor_price');
		$anchor_prices = $this->model_extension_module_anchor_price->getByProductIds($product_ids);

		if (!$anchor_prices) {
			return;
		}

		$this->addAnchorPrices($data, $anchor_prices);
	}

	private function isDefaultCustomerGroup() {
		return (int)$this->config->get('config_customer_group_id') === 1;
	}

	private function collectProductIds(array $node, array &$product_ids) {
		if (isset($node['product_id']) && is_scalar($node['product_id']) && (int)$node['product_id'] > 0) {
			$product_ids[(int)$node['product_id']] = (int)$node['product_id'];
		}

		foreach ($node as $value) {
			if (is_array($value)) {
				$this->collectProductIds($value, $product_ids);
			}
		}
	}

	private function addAnchorPrices(array &$node, array $anchor_prices) {
		if (isset($node['product_id']) && isset($anchor_prices[(int)$node['product_id']])) {
			$can_show_price = !array_key_exists('price', $node) || $node['price'] !== false;

			if ($can_show_price) {
				$anchor = $anchor_prices[(int)$node['product_id']];
				$node['anchor_price_value'] = (float)$anchor['anchor_price'];
				$node['anchor_price'] = $this->currency->format(
					$this->tax->calculate((float)$anchor['anchor_price'], (int)$anchor['tax_class_id'], $this->config->get('config_tax')),
					$this->session->data['currency']
				);
				$node['anchor_reference_date_raw'] = !empty($anchor['reference_date']) ? $anchor['reference_date'] : '';
				$node['anchor_reference_date'] = '';
				$node['anchor_price_text'] = $this->language->get('text_anchor_price');

				if ($this->config->get('module_anchor_price_show_date') && !empty($anchor['reference_date']) && $anchor['reference_date'] !== '0000-00-00') {
					$timestamp = strtotime($anchor['reference_date']);
					$node['anchor_reference_date'] = $timestamp ? date($this->language->get('date_format_anchor'), $timestamp) : '';
					$node['anchor_price_text'] = sprintf($this->language->get('text_anchor_price_date'), $node['anchor_reference_date']);
				}
			}
		}

		foreach ($node as &$value) {
			if (is_array($value)) {
				$this->addAnchorPrices($value, $anchor_prices);
			}
		}
		unset($value);
	}
}

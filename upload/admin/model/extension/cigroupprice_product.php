<?php
class ModelExtensionCiGroupPriceProduct extends Model {
	public function getProductsManufacturers($manufacturer_id) {
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->rows;
	}

	public function getProducts() {
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE product_id  > 0");

		return $query->rows;
	}

	public function getProductPrice($product_id) {
		$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id  = '" . (int)$product_id . "'");

		return isset($query->row['price']) ? $query->row['price'] : 0;
	}

	public function getOptions($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "option` o LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND od.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " AND (o.type = 'radio' OR o.type = 'select' OR o.type = 'checkbox')";

		$sort_data = array(
			'od.name',
			'o.type',
			'o.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY od.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function addTemplate($data) {
		$sql = "INSERT INTO ". DB_PREFIX ."cigroupprice_template SET name = '". $this->db->escape($data['template_name']) ."', setting = '" . $this->db->escape(json_encode($data)) . "', type = '" . $this->db->escape($data['type']) . "'";

		$this->db->query($sql);

		$template_id = $this->db->getLastId();

		return $template_id;
	}

	public function editTemplate($data) {
		$sql = "UPDATE ". DB_PREFIX ."cigroupprice_template SET name = '". $this->db->escape($data['template_name']) ."', setting = '" . $this->db->escape(json_encode($data)) . "' WHERE template_id = '". (int)$data['template_id'] ."'";

		$this->db->query($sql);
	}

	public function getTemplate($template_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "cigroupprice_template p WHERE p.template_id = '". (int)$template_id ."'";

		$query = $this->db->query($sql);

		return $query->row;
	}

	public function getTemplatebyName($name) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "cigroupprice_template p WHERE p.name = '". $this->db->escape($name) ."'";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function deleteTemplate($template_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cigroupprice_template WHERE template_id = '" . (int)$template_id . "'");
	}

	public function getTemplates($data = []) {
		$sql = "SELECT * FROM " . DB_PREFIX . "cigroupprice_template p WHERE p.template_id > 0";

		if (!empty($data['filter_id'])) {
			$sql .= " AND p.template_id = '" . $this->db->escape($data['filter_id']) . "'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " AND p.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_type'])) {
			$sql .= " AND p.type = '" . $this->db->escape($data['filter_type']) . "'";
		}

		$sql .= " GROUP BY p.template_id";

		$sort_data = array(
			'p.name',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY p.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getProductids($data) {
		$this->load->model('extension/cigroupprice');

		$products = [];

		$exclude_products = isset($data['filter_exclude_products']) ? $data['filter_exclude_products'] : [];
		if(!empty($data['filter_type']) && $data['filter_type'] == 'custom_product') {
			$products = $data['filter_products'];
		} elseif(!empty($data['filter_type']) && $data['filter_type'] == 'custom_category') {
			foreach($data['categories'] as $category_id) {
				$results = $this->model_extension_cigroupprice->getProductsCategories($category_id);
				foreach($results as $result) {
					if(!in_array($result['product_id'], $exclude_products)) {
						$products[] = $result['product_id'];
					}
					
				}
			}
			$products = array_unique($products);

		} elseif(!empty($data['filter_type']) && $data['filter_type'] == 'custom_manufacturer') {
			foreach($data['manufacturers'] as $manufacturer_id) {
				$results = $this->getProductsManufacturers($manufacturer_id);
				foreach($results as $result) {
					if(!in_array($result['product_id'],$exclude_products)) {
						$products[] = $result['product_id'];
					}
				}
			}
			$products = array_unique($products);
		} else {
			$allproducts = $this->getProducts();
			foreach ($allproducts as $allproduct) {
				if(!in_array($allproduct['product_id'],$exclude_products)) {
					$products[] = $allproduct['product_id'];
				}
			}
		}

		return $products;
	}

	public function updatePrice($data) {
		$this->load->model('extension/cigroupprice');
		$products = $this->getProductids($data);

		foreach ($data['customer_group_price'] as $customer_group_id => $customer_group_price) {
			if(isset($customer_group_price['status'])) {
				
				foreach ($products as $product_id) {
					$price = $this->getProductPrice($product_id);

					if (!$customer_group_price['basedon']) {
						$price = $customer_group_price['custom_price'];
					}

					if ($customer_group_price['type'] == 'P') {
						$value = $price / 100 * $customer_group_price['value'];
					} elseif ($customer_group_price['type'] == 'F') {
						$value = $customer_group_price['value'];
					}

					$value = $value ? $value : 0;

					if ($customer_group_price['action'] == '+') {
						$price += $value;
					} elseif ($customer_group_price['action'] == '-') {
						$price -= $value;
					}

					if ($customer_group_price['type'] == 'F') {
						if ($customer_group_price['action'] == '=') {
							$price = $value;
						} elseif ($customer_group_price['action'] == 'x') {
							$price = (float)$price * $value;
						} elseif ($customer_group_price['action'] == '/') {
							$price = $price / 100 * $value;							
						}
					}


					$insertdata = [
						'group_price' => $price,
						'product_id' => $product_id,
						'group_id' => $customer_group_id,
					];

					if ($this->model_extension_cigroupprice->getCustomerGroupPrice($customer_group_id,$product_id)) {
						if(isset($customer_group_price['update_existing'])) {
							$this->model_extension_cigroupprice->EditGroupPriceByExcel($insertdata);
						}
					} else {
						$this->model_extension_cigroupprice->AddGroupPriceByExcel($insertdata);
					}
				}
			}
		}
	}

	public function getProductOptions($product_id,$options) {

		$alloptionids = [];
		$alloptionvalueids = [];
		foreach ($options as $option) {
			$alloptionids[] = $option['option_id'];
			if(isset($option['filter_option_value']) && ($option['filter_option'] == 'custom_option')) {
				foreach ($option['filter_option_value'] as $option_value_id) {
					$alloptionvalueids[$option['option_id']][] = $option_value_id;
				}
			}
		}

		$alloptionids = array_unique($alloptionids);
		$alloptionvalueids = array_unique($alloptionvalueids);

		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT po.product_option_id,po.option_id FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' AND po.option_id IN('". implode("','", $alloptionids) ."')");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$sql = "SELECT pov.product_option_value_id,pov.option_value_id,pov.price FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON(pov.option_value_id = ov.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "'";
			if(isset($alloptionvalueids[$product_option['option_id']])) {
				$sql .= "AND pov.option_value_id IN('". implode("','", $alloptionvalueids[$product_option['option_id']]) ."')";
			}

			$sql .= "ORDER BY ov.sort_order ASC";
			
			$product_option_value_query = $this->db->query($sql);

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'price'                   => $product_option_value['price'],
				);
			}

			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
			);
		}

		return $product_option_data;
	}

	public function updateOptionPrice($data) {
		$this->load->model('extension/cigroupprice');
		$products = $this->getProductids($data);

		foreach ($data['customer_group_price'] as $customer_group_id => $customer_group_price) {
			if(isset($customer_group_price['status'])) {
				
				foreach ($products as $product_id) {
					$product_options = $this->getProductOptions($product_id, $data['product_option']);
					
					foreach ($product_options as $product_option) {
						foreach ($product_option['product_option_value'] as $product_option_value) {
							$price = $product_option_value['price'];

							if (!$customer_group_price['basedon']) {
								$price = $customer_group_price['custom_price'];
							}

							if ($customer_group_price['type'] == 'P') {
								$value = $price / 100 * $customer_group_price['value'];
							} elseif ($customer_group_price['type'] == 'F') {
								$value = $customer_group_price['value'];
							}

							$value = $value ? $value : 0;

							if ($customer_group_price['action'] == '+') {
								$price += $value;
							} elseif ($customer_group_price['action'] == '-') {
								$price -= $value;
							}

							if ($customer_group_price['type'] == 'F') {
								if ($customer_group_price['action'] == '=') {
									$price = $value;
								} elseif ($customer_group_price['action'] == 'x') {
									$price = (float)$price * $value;
								} elseif ($customer_group_price['action'] == '/') {
									$price = $price / 100 * $value;							
								}
							}

							$insertdata = [
								'group_price' => $price,
								'product_id' => $product_id,
								'group_id' => $customer_group_id,
								'product_option_id' => $product_option['product_option_id'],
								'product_option_value_id' => $product_option_value['product_option_value_id'],
							];

							if ($this->model_extension_cigroupprice->getCustomerGroupProductOptionPrice($customer_group_id,$product_id,$product_option['product_option_id'],$product_option_value['product_option_value_id'])) {
								if(isset($customer_group_price['update_existing'])) {
									$this->model_extension_cigroupprice->EditOptionValueGroupPriceByExcel($insertdata);
								}
							} else {
								$this->model_extension_cigroupprice->AddOptionValueGroupPriceByExcel($insertdata);
							}
						}
					}
				}
			}
		}
	}
}

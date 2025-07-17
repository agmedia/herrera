<?php
class ModelExtensionCiGroupPrice extends Model {

	public function BuildTableProductPriceGroup() {
	    $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_option_price_by_cigroup` (
	      `product_id` int(11) NOT NULL,
	      `product_option_id` int(11) NOT NULL,
	      `product_option_value_id` int(11) NOT NULL,
	      `group_id` int(11) NOT NULL,
	      `price` decimal(10,4) NOT NULL,
	      PRIMARY KEY (`product_id`,`product_option_id`,`product_option_value_id`,`group_id`)
	    ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

	    $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_price_by_cigroup` (
	      `product_id` int(11) NOT NULL,
	      `group_id` int(11) NOT NULL,
	      `price` decimal(10,4) NOT NULL,
	      PRIMARY KEY (`product_id`,`group_id`)
	    ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

	    $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "cigroupprice_template` (
	      `template_id` int(11) NOT NULL AUTO_INCREMENT,
	      `name` varchar(250) NOT NULL,
	      `type` varchar(32) NOT NULL,
	      `setting` text NOT NULL,
	      PRIMARY KEY (`template_id`)
	    ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
	}

	public function getProductsCategories($category_id) {
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int)$category_id . "'");

		return $query->rows;
	}

	/* Main Product Starts */
	public function getGroupPrice($group_id, $product_id) {
		$query = $this->db->query("SELECT price as group_price FROM " . DB_PREFIX . "product_price_by_cigroup WHERE group_id = '" . (int)$group_id . "' AND product_id = '" . (int)$product_id . "'");

		return $query->row;
	}

	public function getSelectedProducts($data = array()) {
		$products = [];
		// Custom Products
		if(!empty($data['filter_type']) && $data['filter_type'] == 'CUSTOM') {
			$category_products = [];

			if(!empty($data['filter_categories'])) {
				foreach($data['filter_categories'] as $category_id) {
					$results = $this->getProductsCategories($category_id);
					foreach($results as $results) {
						$category_products[$results['product_id']] = $results['product_id'];
					}
				}
			}


			if($category_products || !empty($data['filter_products'])) {
				$product_merge = array_merge($category_products, $data['filter_products']);
			} else {
				$product_merge = [];
			}

			if($product_merge) {
				$products = array_unique($product_merge);
			}
		}

		return $products;
	}

	public function getProductsByCustomerGroupPrices($data = array()) {
		$products = $this->getSelectedProducts($data);

		// Only Customer Group Price
		if(!empty($data['filter_type']) && $data['filter_type'] == 'ONLY_CIGROUP') {
			$selection_columns = ', cigroup.group_id, cigroup.price as group_price ';
		} else {
			$selection_columns = '';
		}

		$sql = "SELECT p.*, pd.name ". $selection_columns ." FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN ". DB_PREFIX ."product_to_store p2s ON (p.product_id = p2s.product_id) ";

		// Only Customer Group Price List
		if(!empty($data['filter_type']) && $data['filter_type'] == 'ONLY_CIGROUP') {
			$sql .= " LEFT JOIN ". DB_PREFIX ."product_price_by_cigroup cigroup ON (p.product_id = cigroup.product_id) ";
		}

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$data['filter_store_id'] . "'";

		// Only Customer Group Price List
		if(!empty($data['filter_type']) && $data['filter_type'] == 'ONLY_CIGROUP') {
			$sql .= " AND p.product_id = cigroup.product_id ";
		}

		// Custom Products
		if(!empty($data['filter_type']) && $data['filter_type'] == 'CUSTOM') {
			if(!empty($products)) {
				$sql .= " AND p.product_id IN(". implode(',', $products) .")";
			}
		}

		$sql .= " ORDER BY pd.name ASC ";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	/* Main Product Ends */

	/* Option Value Product Starts */
	public function getProductOptionsByCustomerGroupPrices($data = array()) {
		$products = $this->getSelectedProducts($data);

		// Only Customer Group Price
		if(!empty($data['filter_type']) && $data['filter_type'] == 'ONLY_CIGROUP') {
			$selection_columns = ', cigroup.group_id, cigroup.price as group_price ';
		} else {
			$selection_columns = '';
		}

		$sql = "SELECT p.product_id, pd.name ". $selection_columns .", pov.product_option_id, pov.product_option_value_id FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "product p ON(pov.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN ". DB_PREFIX ."product_to_store p2s ON (p.product_id = p2s.product_id) ";

		// Only Customer Group Price List
		if(!empty($data['filter_type']) && $data['filter_type'] == 'ONLY_CIGROUP') {
			$sql .= " LEFT JOIN ". DB_PREFIX ."product_option_price_by_cigroup cigroup ON (pov.product_option_value_id  = cigroup.product_option_value_id ) ";
		}

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$data['filter_store_id'] . "'";

		// Only Customer Group Price List
		if(!empty($data['filter_type']) && $data['filter_type'] == 'ONLY_CIGROUP') {
			$sql .= " AND pov.product_option_value_id = cigroup.product_option_value_id ";
		}

		// Custom Products
		if(!empty($data['filter_type']) && $data['filter_type'] == 'CUSTOM') {
			if(!empty($products)) {
				$sql .= " AND p.product_id IN(". implode(',', $products) .")";
			}
		}

		$sql .= " ORDER BY pd.name ASC ";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getOptionValueGroupPrice($group_id, $product_id, $product_option_value_id) {
		$query = $this->db->query("SELECT price as group_price FROM " . DB_PREFIX . "product_option_price_by_cigroup WHERE group_id = '" . (int)$group_id . "' AND product_id = '" . (int)$product_id . "' AND product_option_value_id = '" . (int)$product_option_value_id . "'");

		return $query->row;
	}

	public function getProductOptionName($product_option_id, $product_id) {
		$query = $this->db->query("SELECT po.product_option_id, od.name FROM ". DB_PREFIX ."product_option po LEFT JOIN ". DB_PREFIX ."option_description od ON(po.option_id = od.option_id) WHERE po.product_option_id = '" . (int)$product_option_id . "' AND po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getProductValueOptionName($product_option_value_id, $product_id) {
		$query = $this->db->query("SELECT pov.product_option_value_id, ovd.name FROM ". DB_PREFIX ."product_option_value pov LEFT JOIN ". DB_PREFIX ."option_value_description ovd ON(pov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_id = '" . (int)$product_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	/* Option Value Product Ends */







	/* Main Product Starts */
	public function getCustomerGroupPrice($group_id, $product_id) {
		$query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "product_price_by_cigroup WHERE group_id = '" . (int)$group_id . "' AND product_id = '" . (int)$product_id . "'");

		return $query->row['total'];
	}


	public function EditGroupPriceByExcel($send_data) {
		$sql = "UPDATE ". DB_PREFIX ."product_price_by_cigroup SET price = '". (float)$send_data['group_price'] ."' WHERE product_id = '". (int)$send_data['product_id'] ."' AND group_id = '". (int)$send_data['group_id'] ."'";

		$this->db->query($sql);
	}

	public function AddGroupPriceByExcel($send_data) {
		$sql = "INSERT INTO ". DB_PREFIX ."product_price_by_cigroup SET price = '". (float)$send_data['group_price'] ."', product_id = '". (int)$send_data['product_id'] ."', group_id = '". (int)$send_data['group_id'] ."'";

		$this->db->query($sql);
	}
	/* Main Product Ends */









	/* Option Value Product Starts */
	public function getProductOptionValue($product_id, $product_option_id, $product_option_value_id) {
		$query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "product_option_value WHERE product_option_id = '" . (int)$product_option_id . "' AND product_option_value_id = '" . (int)$product_option_value_id . "' AND product_id = '" . (int)$product_id . "'");

		return $query->row['total'];
	}

	public function getCustomerGroupProductOptionPrice($group_id, $product_id, $product_option_id, $product_option_value_id) {
		$query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "product_option_price_by_cigroup WHERE group_id = '" . (int)$group_id . "' AND product_id = '" . (int)$product_id . "' AND product_option_id = '" . (int)$product_option_id . "' AND product_option_value_id = '" . (int)$product_option_value_id . "'");

		return $query->row['total'];
	}

	public function EditOptionValueGroupPriceByExcel($send_data) {
		$sql = "UPDATE ". DB_PREFIX ."product_option_price_by_cigroup SET price = '". (float)$send_data['group_price'] ."' WHERE product_id = '". (int)$send_data['product_id'] ."' AND group_id = '". (int)$send_data['group_id'] ."' AND product_option_id = '". (int)$send_data['product_option_id'] ."' AND product_option_value_id = '". (int)$send_data['product_option_value_id'] ."'";

		$this->db->query($sql);
	}

	public function AddOptionValueGroupPriceByExcel($send_data) {
		$sql = "INSERT INTO ". DB_PREFIX ."product_option_price_by_cigroup SET price = '". (float)$send_data['group_price'] ."', product_id = '". (int)$send_data['product_id'] ."', group_id = '". (int)$send_data['group_id'] ."', product_option_id = '". (int)$send_data['product_option_id'] ."', product_option_value_id = '". (int)$send_data['product_option_value_id'] ."'";

		$this->db->query($sql);
	}
	/* Option Value Product Ends */
}
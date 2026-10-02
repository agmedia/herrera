<?php
class ModelExtensionModuleAnchorPrice extends Model {
	public function getByProductIds(array $product_ids) {
		$product_ids = array_values(array_unique(array_filter(array_map('intval', $product_ids))));

		if (!$product_ids) {
			return array();
		}

		$query = $this->db->query("SELECT ap.`product_id`, ap.`anchor_price`, ap.`reference_date`, p.`tax_class_id`
			FROM `" . DB_PREFIX . "product_anchor_price` ap
			LEFT JOIN `" . DB_PREFIX . "product` p ON (p.`product_id` = ap.`product_id`)
			WHERE ap.`product_id` IN (" . implode(',', $product_ids) . ") AND ap.`anchor_price` > 0");
		$data = array();

		foreach ($query->rows as $row) {
			$data[(int)$row['product_id']] = $row;
		}

		return $data;
	}
}

<?php
class ModelExtensionOrdertracking extends Model {
	
	public function getOrderTrackingnumber ($order_id) {
						$sql="SELECT * FROM `" . DB_PREFIX . "order_tracking` where order_id='".$order_id."'";
						$query = $this->db->query($sql);
						return $query->row;
					}
					

public function getordertracking($data) {

					$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` o LEFT JOIN " . DB_PREFIX . "order_tracking ot ON o.order_id = ot.order_id WHERE o.order_id = '" .(int)$data['order_id'] . "' and o.email='".$this->db->escape($data['email'])."'");

					return $query->row;
				}
public function getOrderstatus($order_status_id) {
		$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "'");

		return $query->row;
	}
	public function getOrderinfo($data) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$data['order_id'] . "' and email='".$this->db->escape($data['email'])."'");

		return $query->row;
	}


}
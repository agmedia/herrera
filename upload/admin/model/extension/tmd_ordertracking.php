<?php
class ModelExtensionTmdOrdertracking extends Model {
	
	public function install() {

		$this->db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."order_tracking` (
		  `order_tracking_id` int(11) NOT NULL AUTO_INCREMENT,
		  `order_id` int(11) NOT NULL,
		  `shipingcompany` varchar(255) NOT NULL,
		  `tracking_number` varchar(200) NOT NULL,
		  `date_added` date NOT NULL,
		  PRIMARY KEY (`order_tracking_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
	}
	
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."order_tracking`");
	}
}

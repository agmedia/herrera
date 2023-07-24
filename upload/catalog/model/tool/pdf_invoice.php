<?php
register_shutdown_function('pdfinv_fatal_handler');

function pdfinv_fatal_handler() {
  $error = error_get_last();

  if(!empty($error['type']) && $error['type'] == '1') {
    if( $error !== NULL) {
      echo 'Error: ' . $error['message'] . ' in ' . $error['file'] . ' on line '  . $error['line'];
    } else {
      echo 'Unknown fatal error';
    }
  }
}

function pdfinv_log_err( $num, $str, $file, $line, $context = null){
  file_put_contents( DIR_SYSTEM . "logs/pdf_error.log", $str .' in '.$file .' on line '. $line . PHP_EOL, FILE_APPEND );
}

class PdfLanguage {
	private $default = 'english';
	private $directory;
	private $data = array();

	public function __construct($directory) {
		$this->directory = $directory;
		$this->load($directory);
		$this->load('module/pdf_invoice');
	}

	public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : $key);
	}

  public function set($key, $val) {
		$this->data[$key] = $val;
	}
  
	public function load($filename) {
		$file = DIR_SYSTEM . '../catalog/language/' . $this->directory . '/' . $filename . '.php';
		
		if (file_exists($file)) {
			$_ = array();
			require($file);
			$this->data = array_merge($this->data, $_);
			return $this->data;
		}

		$file = DIR_SYSTEM . '../catalog/language/' . $this->default . '/' . $filename . '.php';

		if (file_exists($file)) {
			$_ = array();
			require($file);
			$this->data = array_merge($this->data, $_);
			return $this->data;
		} else {
			return $this->data;
			//trigger_error('Error: Could not load language ' . $filename . '!');
		}
	}
}

class ModelToolPdfInvoice extends Model {

	/**************************
	*
	* @orders: order numbers
	* @mode: display, file, backup
	* @type: invoice, packingslip
	*
	***************************/
	public function generate($orders, $mode = 'display', $type = 'invoice', $lang = '', $params = array(), $mail = null) {
		$orders = is_array($orders) ? $orders : array($orders);
		
    $lang_id = $this->config->get('config_language_id');
    
		$data['config'] = &$this->config;
		
		/*
		$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', 'account/order');
		include_once(VQMod::modCheck(DIR_SYSTEM . '../catalog/model/account/order.php'));	
		$this->registry->set('model_' . str_replace('/', '_', 'account/order'), new $class($this->registry));
		*/
		
		if (defined('DIR_CATALOG')) {
			$template_path = '../../../catalog/view/theme/';
    } else {
      $template_path = '';
    }
    
		if (defined('PDF_INVOICE_ADMIN')) {
			$basepath = (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) ? HTTPS_CATALOG : HTTP_CATALOG;
			$this->load->model('sale/order');
			$order_model = 'model_sale_order';
			$order_model2 = 'model_sale_order';
			//$template_path = '../../../catalog/view/theme/';
		} else {
			$basepath = (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) ? HTTPS_SERVER : HTTP_SERVER;
			$this->load->model('account/order');
			$order_model = 'model_checkout_order';
			$order_model2 = 'model_account_order';
			$this->load->model('checkout/order');
			//$template_path = '';
		}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$http_image = defined('_JEXEC') ? HTTP_IMAGE : $basepath . 'image/';
		} else {
			$http_image = defined('_JEXEC') ? HTTP_IMAGE : $basepath . 'image/';
		}
		
		$this->load->model('setting/setting');

		$pdf_html = '';
    $current_store = (int) $this->config->get('config_store_id');
    
		foreach ($orders as $order_id) {
    
    if ($type == 'recurring') {
      if (defined('PDF_INVOICE_ADMIN')) {
        $this->load->model('sale/recurring');
        $recurring_model = 'model_sale_recurring';
        
        $data['recurring_info'] = $recurring_info = $this->{$recurring_model}->getRecurring($order_id);
        //$results = $this->{$recurring_model}->getRecurringTransactions($recurring_info['order_recurring_id']);
        $results = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_recurring_transaction` WHERE `order_recurring_id` = '" . (int)$order_id . "'")->rows;
      } else {
        $this->load->model('account/recurring');
        $recurring_model = 'model_account_recurring';
      
       $data['recurring_info'] = $recurring_info = $this->{$recurring_model}->getOrderRecurring($order_id);
       $results = $this->{$recurring_model}->getOrderRecurringTransactions($recurring_info['order_recurring_id']);
      }
      
      foreach ($results as $result) {
				$data['transactions'][] = array(
					'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'type'       => $result['type'],
					'amount'     => $this->currency->format($result['amount'], $recurring_info['currency_code'])
				);
			}
      
      // var_dump($recurring_info);
      // var_dump($recurring_transactions);
      // die;
      
      $order_id = $recurring_info['order_id'];
      
      $order_info = $this->{$order_model}->getOrder($order_id);
    } else if ($type == 'return') {
      $this->load->model('sale/return');
      $return_info = $this->model_sale_return->getReturn($order_id);
      $order_id = $return_info['order_id'];
      
      $order_info = $this->{$order_model}->getOrder($order_id);
      
      $order_products = $this->{$order_model}->getOrderProducts($order_id);

      $order_product = array();
      
      foreach ($order_products as $prod) {
        if ($prod['product_id'] == $return_info['product_id'] || $prod['name'] == $return_info['product']) {
          $order_product = $prod;
        }
      }
    
      if (!empty($order_product)) {
        $return_info['product_price'] = $this->currency->format($order_product['price']+$order_product['tax'], $order_info['currency_code'], $order_info['currency_value']);
        $return_info['product_tax'] = $order_product['tax'];
      }
    } else {
      $order_info = $this->{$order_model}->getOrder($order_id);
    }

    if ($type == 'return' && !$order_info) {
      die('Error: Return must be linked to valid order number');
    }
    
		if ($order_info) {
			$data['order'] = &$order_info;

      // Overwrite store settings
      if ($current_store != (int) $order_info['store_id']) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '".(int) $order_info['store_id']."'");
        
        foreach ($query->rows as $setting) {
          if (!$setting['serialized']) {
            $this->config->set($setting['key'], $setting['value']);
          } else if (version_compare(VERSION, '2.1', '>=')) {
            $this->config->set($setting['key'], json_decode($setting['value'], true));
          } else {
            $this->config->set($setting['key'], unserialize($setting['value']));
          }
        }
        
        $current_store = (int) $order_info['store_id'];
      }
    
      if (defined('PDF_INVOICE_ADMIN')) {
        if ($this->config->get('pdf_invoice_custom_fields')) {
          if (version_compare(VERSION, '2.1', '>=')) {
            $this->load->model('customer/custom_field');
            $custom_field_model = 'model_customer_custom_field';
          } else {
            $this->load->model('sale/custom_field');
            $custom_field_model = 'model_sale_custom_field';
          }
        }
      } else {
        if ($this->config->get('pdf_invoice_custom_fields')) {
          $this->load->model('account/custom_field');
          $custom_field_model = 'model_account_custom_field';
        }
      }
      
      if (isset($_newpage)) {
        $data['_newpage'] = true;
      }
      
      $_newpage = true;
				
			// language
			$this->load->model('localisation/language');
      
      if ($lang) {
        $user_lang = $this->model_localisation_language->getLanguage($lang);
      } else if ($this->config->get('pdf_invoice_force_lang')) {
        $user_lang = $this->model_localisation_language->getLanguage($this->config->get('pdf_invoice_force_lang'));
			} else {
				$user_lang = $this->model_localisation_language->getLanguage($order_info['language_id']);
			}

      if (empty($user_lang)) {
        $user_lang = $this->model_localisation_language->getLanguage($this->config->get('config_language_id'));
      }
      
      // to use with date_function
      setlocale(LC_TIME, explode(',', $user_lang['locale']));

			//$lang_dir = $user_lang['directory'];
			$lang_code = $user_lang['code'];
			$lang_id = $user_lang['language_id'];
			
			if (defined('_JEXEC') && version_compare(VERSION, '3', '<')) {
				if(strpos($user_lang['locale'], '.') !== false) {
          $language = new PdfLanguage(str_replace('_', '-',strstr($user_lang['locale'], '.', true)));
        } else {
          $language = new PdfLanguage($user_lang['locale']);
        }
			} else if (version_compare(VERSION, '2.2', '>=')) {
				$language = new PdfLanguage($user_lang['code']);
			} else {
				$language = new PdfLanguage($user_lang['directory']);
			}
			
      $date_format = $language->get('pdf_date_format');
      $date_function = 'strftime';

      if ($date_format == 'pdf_date_format') $date_format = 'd/m/Y';

			if (strpos($date_format, '%') === false) {
        //$date_format = '%m/%d/%Y';
        $date_function = 'date';
			}
      
      if ($type == 'return' && !empty($return_info)) {
        $return_info['date_added'] = $date_function($language->get('pdf_date_format'), strtotime($return_info['date_added']));
        $return_info['date_modified'] = $date_function($language->get('pdf_date_format'), strtotime($return_info['date_modified']));

        $locquery = $this->db->query("SELECT name FROM " . DB_PREFIX . "return_reason WHERE return_reason_id = '" . (int)$return_info['return_reason_id'] . "' AND language_id = '" . (int)$lang_id . "'")->row;
        $return_info['return_reason'] = $locquery['name'];
        
        $locquery = $this->db->query("SELECT name FROM " . DB_PREFIX . "return_action WHERE return_action_id = '" . (int)$return_info['return_action_id'] . "' AND language_id = '" . (int)$lang_id . "'")->row;
        $return_info['return_action'] = !empty($locquery['name']) ? $locquery['name'] : '';
        
        $locquery = $this->db->query("SELECT name FROM " . DB_PREFIX . "return_status WHERE return_status_id = '" . (int)$return_info['return_status_id'] . "' AND language_id = '" . (int)$lang_id . "'")->row;
        $return_info['return_status'] = !empty($locquery['name']) ? $locquery['name'] : '';
        
        if (!empty($order_info['order_id_user'])) {
         $return_info['order_id'] = $order_info['order_id_user'];
        }
        
        $data['return'] = $return_info;
      }
    
			$data['language'] = &$language;
			
			//data
			$data['direction'] = $language->get('direction');
			$data['lang_code'] = $lang_code;
			$data['lang_id'] = $lang_id;

			$data['text_invoice'] = $language->get('text_invoice');
      
      $data['title'] = $language->get('text_proformat');
      
      if ($order_info['invoice_no']) {
        $data['title'] = $language->get('text_invoice');
      }

			$data['text_order_id'] = $language->get('text_order_id');
			$data['text_invoice_no'] = $language->get('text_invoice_no');
			$data['text_invoice_date'] = $language->get('text_invoice_date');
			$data['text_date_added'] = $language->get('text_date_added');
			$data['text_date_due'] = $language->get('text_date_due');
			$data['text_telephone'] = $language->get('text_telephone');
			$data['text_email'] = $language->get('text_email');
			$data['text_fax'] = $language->get('text_fax');
			$data['text_url'] = $language->get('text_url');
			$data['text_company_id'] = $language->get('text_company_id');
			$data['text_tax_id'] = $language->get('text_tax_id');		
			$data['text_payment_method'] = $language->get('text_payment_method');
			$data['text_shipping_method'] = $language->get('text_shipping_method');
			$data['text_po_number'] = $language->get('text_po_number');
      $data['text_paid'] = $language->get('text_paid');

			$data['text_product'] = $language->get('column_product');
			$data['text_model'] = $language->get('column_model');
			$data['text_quantity'] = $language->get('column_quantity');
			$data['text_weight'] = $language->get('column_weight');
			$data['text_price'] = $language->get('column_price');
			$data['text_tax'] = $language->get('column_tax');
			$data['text_total'] = $language->get('column_total');
			
			//missing values
			$data['text_customer_id'] = $language->get('text_customer_id');
			$data['text_order_detail'] = $language->get('text_order_detail');
			$data['text_payment_address'] = $language->get('text_payment_address');
			$data['text_shipping_address'] = $language->get('text_shipping_address');
			$data['text_email'] = $language->get('text_email');
			$data['base'] = $basepath;
			
      $data['logo'] = DIR_IMAGE . $this->config->get('pdf_invoice_logo');
      /* always use direct path, better than url
      if (defined('_JEXEC')) {
        $data['logo'] = DIR_IMAGE . $this->config->get('pdf_invoice_logo');
      } else {
        $data['logo'] = $order_info['store_url'] . 'image/' . $this->config->get('pdf_invoice_logo');
      }
      */
			
			// get and filter columns
			if ($type == 'packingslip') {
				$columns = (array) $this->config->get('pdf_invoice_slip_columns');
			} else if ($type == 'recurring') {
				$columns = array('date_added' => 1, 'type' => 1, 'amount' => 1);
			} else {
				$columns = (array) $this->config->get('pdf_invoice_columns');
			}
			
			foreach($columns as $col => $enabled) {
				if(!$enabled) unset($columns[$col]);
			}
			
			$columns = array_keys($columns);
			$data['columns'] = &$columns;

      $orig_columns = $columns;
      
			// get and filter product options
			$prod_options = (array) $this->config->get('pdf_invoice_options');
			
			foreach($prod_options as $col => $enabled) {
				if(!$enabled) unset($prod_options[$col]);
			}
			
			$prod_options = array_keys($prod_options);
			$data['options'] = $prod_options;
			
			if($this->config->get('pdf_invoice_customerid')) {
				$data['customer_id'] = sprintf('%1$s%2$0'.$this->config->get('pdf_invoice_customersize').'d', $this->config->get('pdf_invoice_customerprefix'),  $order_info['customer_id']);
			} else {
				$data['customer_id'] = false;
			}
			
			// get barcode
			if($type == 'packingslip') {
				$data['barcode'] = (array) $this->config->get('pdf_invoice_slip_barcode');
			} else {
				$data['barcode'] = (array) $this->config->get('pdf_invoice_barcode');
			}
      
      // comment for bank instructions etc
			$data['text_instruction'] =  $language->get('text_instruction');
      
      $data['order_comment'] = '';
      if (!empty($params['order_comment'])) {
        $data['order_comment'] = $params['order_comment'];
      }
      
			// customer comment
			$data['comment'] = '';
      
      if (($type == 'packingslip' && $this->config->get('pdf_invoice_slip_usercomment')) || ($type != 'packingslip' && $this->config->get('pdf_invoice_usercomment'))) {
        $data['comment'] = nl2br($order_info['comment']);
      }
			
      // fix language id
      $this->config->set('config_language_id', $lang_id);
      
      // custom fields (2.0 only)
      $data['custom_fields'] = $data['payment_custom_fields'] = $data['shipping_custom_fields'] = array();
      
      if ($this->config->get('pdf_invoice_custom_fields')) {
        foreach ($this->config->get('pdf_invoice_custom_fields') as $custom_field_id) {
          $custom_field = $this->{$custom_field_model}->getCustomField($custom_field_id);
          
          if(isset($custom_field['custom_field_id']) && isset($order_info['custom_field'][$custom_field['custom_field_id']]) && $order_info['custom_field'][$custom_field['custom_field_id']]) {
            $data['custom_fields'][] = array(
              'name' => $custom_field['name'],
              'value' => $order_info['custom_field'][$custom_field['custom_field_id']],
              'sort_order' => $custom_field['sort_order'],
            );
          }
        
          if(isset($custom_field['custom_field_id']) && isset($order_info['payment_custom_field'][$custom_field['custom_field_id']]) && $order_info['payment_custom_field'][$custom_field['custom_field_id']]) {
            $cf_val = '';
            if($custom_field['type'] == 'select' || $custom_field['type'] == 'radio' || $custom_field['type'] == 'checkout'){
                $cf_val = $this->db->query("SELECT name FROM ".DB_PREFIX."custom_field_value_description WHERE custom_field_id = '".(int)$custom_field['custom_field_id']."' AND custom_field_value_id = '".$order_info['payment_custom_field'][$custom_field['custom_field_id']]."'")->row['name'];
            } else {
                $cf_val = $order_info['payment_custom_field'][$custom_field['custom_field_id']];
            }
            
            $data['payment_custom_fields'][] = array(
              'name' => $custom_field['name'],
              'value' => $cf_val,
              'sort_order' => $custom_field['sort_order'],
            );
          }
          
          if(isset($custom_field['custom_field_id']) && isset($order_info['shipping_custom_field'][$custom_field['custom_field_id']]) && $order_info['shipping_custom_field'][$custom_field['custom_field_id']]) {
            $cf_val = '';
            if($custom_field['type'] == 'select' || $custom_field['type'] == 'radio' || $custom_field['type'] == 'checkout'){
                $cf_val = $this->db->query("SELECT name FROM ".DB_PREFIX."custom_field_value_description WHERE custom_field_id = '".(int)$custom_field['custom_field_id']."' AND custom_field_value_id = '".$order_info['payment_custom_field'][$custom_field['custom_field_id']]."'")->row['name'];
            } else {
                $cf_val = $order_info['payment_custom_field'][$custom_field['custom_field_id']];
            }
            
            $data['shipping_custom_fields'][] = array(
              'name' => $custom_field['name'],
              'value' => $cf_val,
              'sort_order' => $custom_field['sort_order'],
            );
          }
        }
        
        usort($data['custom_fields'], array($this, 'cmp'));
        usort($data['payment_custom_fields'], array($this, 'cmp'));
        usort($data['shipping_custom_fields'], array($this, 'cmp'));
      }
      
			/*
			$data['custom_title'] = $this->config->get('pdf_invoice_title_'.$lang_code) ? $this->config->get('pdf_invoice_title_'.$lang_code) : $language->get('text_instruction');
			$data['custom_comment'] = html_entity_decode($this->config->get('pdf_invoice_message_'.$lang_code), ENT_QUOTES, 'UTF-8');
			*/
			
			// custom blocks
			$data['blocks_top'] =
			$data['blocks_middle'] = 
			$data['blocks_bottom'] = 
			$data['blocks_footer'] = 
			$data['blocks_newpage'] = array();
			
			$blocks = $this->config->get('pdf_invoice_blocks');
      
			if ($blocks) {
				foreach ($blocks as $block) {
					if(!empty($block['target']) && $block['target'] != $type) continue;
					list($display, $value) = explode('|', $block['display']);
					if($display == 'always' && $value == 0) continue;
					elseif($display == 'credit' && (($value && $order_info['total'] > 0) || (!$value && $order_info['total'] < 0))) continue;
					elseif($display == 'invnum' && (($value && !$order_info['invoice_no']) || (!$value && $order_info['invoice_no']))) continue;
					elseif($display == 'comment' && $value == 1 && $order_info['comment']) continue;
					elseif($display == 'customer_group_id' && $value != $order_info['customer_group_id']) continue;
					elseif($display == 'order_status_id' && $value != $order_info['order_status_id']) continue;
					elseif($display == 'payment_code' && $value != $order_info['payment_code']) continue;
					elseif($display == 'shipping_zone') {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$value . "' AND country_id = '" . (int)$order_info['shipping_country_id'] . "' AND (zone_id = '" . (int)$order_info['shipping_zone_id'] . "' OR zone_id = '0')");
						if (!$query->num_rows) continue 1;
					}
					elseif($display == 'payment_zone') {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$value . "' AND country_id = '" . (int)$order_info['payment_country_id'] . "' AND (zone_id = '" . (int)$order_info['payment_zone_id'] . "' OR zone_id = '0')");
						if (!$query->num_rows) continue 1;
					}
					elseif($display == 'shipping_code' && strpos($order_info['shipping_code'], $value) === false) continue;
					//elseif($type == 'packingslip' && $display != 'packing_slip') continue;
					elseif($display == 'tracking' && empty($order_info['tracking_no'])) continue;
					
					if ($block['display']) {
						$data['blocks_'.$block['position']][] = array(
							'title' => $block['title'][$lang_id],
							'description' =>  html_entity_decode($block['description'][$lang_id], ENT_QUOTES, 'UTF-8'),
							'sort_order' => $block['sort_order'],
							'inline' => !empty($block['inline'])
						);
					}
				}
			}
			
			foreach (array('top', 'middle', 'bottom', 'newpage') as $pos) {
				if($data['blocks_'.$pos]) {
					usort($data['blocks_'.$pos], array($this, 'cmp'));
				}
			}
			
			$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
			
			if ($store_info) {
				$store_address = $store_info['config_address'];
				$store_email = $store_info['config_email'];
				$store_telephone = $store_info['config_telephone'];
				$store_fax = $store_info['config_fax'];
			} else {
				$store_address = $this->config->get('config_address');
				$store_email = $this->config->get('config_email');
				$store_telephone = $this->config->get('config_telephone');
				$store_fax = $this->config->get('config_fax');
			}
			
			if ($order_info['shipping_address_format']) {
				$format = $order_info['shipping_address_format'];
			} else {
				$format = '{company}' . "\n" . '{firstname} {lastname}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
			}

			$find = array(
				'{firstname}',
				'{lastname}',
				'{company}',
				'{address_1}',
				'{address_2}',
				'{city}',
				'{postcode}',
				'{zone}',
				'{zone_code}',
				'{country}'
			);

			$replace = array(
				'firstname' => $order_info['shipping_firstname'],
				'lastname'  => $order_info['shipping_lastname'],
				'company'   => $order_info['shipping_company'],
				'address_1' => $order_info['shipping_address_1'],
				'address_2' => $order_info['shipping_address_2'],
				'city'      => $order_info['shipping_city'],
				'postcode'  => $order_info['shipping_postcode'],
				'zone'      => $order_info['shipping_zone'],
				'zone_code' => $order_info['shipping_zone_code'],
				'country'   => $order_info['shipping_country']
			);

      // custom fields (2.0 only)
      if (isset($order_info['shipping_custom_field']) && is_array($order_info['shipping_custom_field'])) {
        foreach ($order_info['shipping_custom_field'] as $cf_id =>  $cf_value) {
          $find[] = '{custom_field_'.$cf_id.'}';
          
          if (is_scalar($cf_value)) {
            $replace[] = $cf_value;
          } else if (is_array($cf_value) && isset($cf_value[0])) {
            $replace[] = $cf_value[0];
          } else {
            $replace[] = '';
          }
        }
      }
    
			$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

			if ($order_info['payment_address_format']) {
				$format = $order_info['payment_address_format'];
			} else {
				$format = '{company}' . "\n" . '{firstname} {lastname}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
			}

			$find = array(
				'{firstname}',
				'{lastname}',
				'{company}',
				'{address_1}',
				'{address_2}',
				'{city}',
				'{postcode}',
				'{zone}',
				'{zone_code}',
				'{country}'
			);

			$replace = array(
				'firstname' => $order_info['payment_firstname'],
				'lastname'  => $order_info['payment_lastname'],
				'company'   => $order_info['payment_company'],
				'address_1' => $order_info['payment_address_1'],
				'address_2' => $order_info['payment_address_2'],
				'city'      => $order_info['payment_city'],
				'postcode'  => $order_info['payment_postcode'],
				'zone'      => $order_info['payment_zone'],
				'zone_code' => $order_info['payment_zone_code'],
				'country'   => $order_info['payment_country']
			);

      // custom fields (2.0 only)
      if (isset($order_info['payment_custom_field']) && is_array($order_info['payment_custom_field'])) {
        foreach ($order_info['payment_custom_field'] as $cf_id =>  $cf_value) {
          $find[] = '{custom_field_'.$cf_id.'}';
          
          if (is_scalar($cf_value)) {
            $replace[] = $cf_value;
          } else if (is_array($cf_value) && isset($cf_value[0])) {
            $replace[] = $cf_value[0];
          } else {
            $replace[] = '';
          }
        }
      }
      
			$payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

			$product_data = array();
			
			$products = $this->{$order_model2}->getOrderProducts($order_id);
			
      $data['total_items'] = $data['total_weight'] = 0;
      
			foreach ($products as $product) {
				$option_data = array();

				$options = $this->{$order_model2}->getOrderOptions($order_id, $product['order_product_id']);
				
				$get_full_product = true;
				$full_product = array(
					'attributes' => null,
					'image' => null,
					'mpn' => null,
					'isbn' => null,
					'manufacturer_id' => null,
					'location' => null,
					'description' => null,
					'upc' => null,
					'sku' => null,
					'ean' => null,
					'weight' => null,
					'weight_class_id' => null,
					'sort_order' => null,
				);
				
				/*
				if($type == 'invoice') {
					if($this->config->get('pdf_invoice_col_image')) $get_full_product = true;
					if($this->config->get('pdf_invoice_col_weight')) $get_full_product = true;
				}
				if($type == 'packingslip') {
					$get_full_product = true;
				}
				*/
				
				if($get_full_product) {
					$this->load->model('catalog/product');
          $full_product = array_merge($full_product, (array) $this->model_catalog_product->getProduct($product['product_id']));
				}
				
        $data['total_items'] += $product['quantity'];
        
        if (!empty($full_product['weight'])) {
          $data['total_weight'] += $this->weight->convert($full_product['weight'], $full_product['weight_class_id'], $this->config->get('config_weight_class_id')) * $product['quantity'];
        }
        
        if (!empty($full_product['description'])) {
          $full_product['description'] = html_entity_decode($full_product['description'], ENT_QUOTES, 'UTF-8');
        }
        
				if (in_array('barcode', $columns)) {
          if ($type == 'packingslip') {
            $colBcode = $this->config->get('pdf_invoice_slip_col_barcode');
          } else {
            $colBcode = $this->config->get('pdf_invoice_col_barcode');
          }
          
          if (isset($full_product[$colBcode['value']])) {
            $full_product['barcode'] = '<barcode type="'.$colBcode['type'].'" code="'.$full_product[$colBcode['value']].'" height="0.5"/>';
            //$full_product['barcode'] = '<barcode type="'.$colBcode['type'].'" code="'.$full_product[$colBcode['value']].'" height="0.5"/><div style="font-size:10px">'. $product['name'] . '</div>';
          }
        }
        
        if ($type == 'packingslip') {
          $imageThumbWidth = $this->config->get('pdf_invoice_packingslip_thumbwidth') ? $this->config->get('pdf_invoice_packingslip_thumbwidth') : $this->config->get('pdf_invoice_thumbwidth');
          $imageThumbHeight = $this->config->get('pdf_invoice_packingslip_thumbheight') ? $this->config->get('pdf_invoice_packingslip_thumbheight') : $this->config->get('pdf_invoice_thumbheight');
        } else {
          $imageThumbWidth = $this->config->get('pdf_invoice_thumbwidth');
          $imageThumbHeight = $this->config->get('pdf_invoice_thumbheight');
        }
        
				if($full_product['image'] && in_array('image', $columns)) {
					$this->load->model('tool/image');
					$full_product['image'] = $this->model_tool_image->resize($this->getProductImage($product['product_id']), $imageThumbWidth, $imageThumbHeight);
					//$full_product['image'] = str_replace($http_image, DIR_IMAGE, $full_product['image']);
          $full_product['image'] = str_replace('https://', 'http://', $full_product['image']);
				}
				
				$manufacturer = '';
				if(in_array('manufacturer', $prod_options) || in_array('manufacturer', $columns)) {
					$manufacturer = $this->getManufacturer($full_product['manufacturer_id']);
				}
				
				if (in_array('quantity', $prod_options)) {
					$product['name'] = $product['quantity'] . ' x ' . $product['name'];
				}
				
				if(in_array('model', $prod_options) && $product['model']) {
					$option_data[] = array(
						'name'  => $language->get('column_model'),
						'value' => $product['model']
					);
				}
				
        if(in_array('sku', $prod_options) && $full_product['sku']) {
					$option_data[] = array(
						'name'  => $language->get('column_sku'),
						'value' => $full_product['sku']
					);
				}
        
        if(in_array('mpn', $prod_options) && $full_product['mpn']) {
					$option_data[] = array(
						'name'  => $language->get('column_mpn'),
						'value' => $full_product['mpn']
					);
				}
        
        if(in_array('isbn', $prod_options) && $full_product['isbn']) {
					$option_data[] = array(
						'name'  => $language->get('column_isbn'),
						'value' => $full_product['isbn']
					);
				}
        
        if(in_array('ean', $prod_options) && $full_product['ean']) {
					$option_data[] = array(
						'name'  => $language->get('column_ean'),
						'value' => $full_product['ean']
					);
				}
        
				if(in_array('upc', $prod_options) && $full_product['upc']) {
					$option_data[] = array(
						'name'  => $language->get('column_upc'),
						'value' => $full_product['upc']
					);
				}
				
				if(in_array('manufacturer', $prod_options) && $manufacturer) {
					$option_data[] = array(
						'name'  => $language->get('column_manufacturer'),
						'value' => $manufacturer
					);
				}
				
				foreach ($options as $option) {
					if ($option['type'] != 'file') {
            $option_data[] = array(
              'name'  => $option['name'],
              'value' => $option['value']
            );
					} else {
            if (version_compare(VERSION, '2', '>=')) {
              $this->load->model('tool/upload');
              $upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

              if ($upload_info) {
                $option_data[] = array(
                  'name'  => $option['name'],
                  'value' => $upload_info['name']
                );
              }
            } else {
              $value = utf8_substr($option['value'], 0, utf8_strrpos($option['value'], '.'));
            }
					}
				}
				
          if (!isset($order_info['customer_group_id'])) {
            $order_info['customer_group_id'] = 0;
          }
          
        if (in_array('attributes', $prod_options) || in_array('attributes', $columns) || in_array('attribute_group', $orig_columns)) {
          $product_attributes = $this->getProductAttributes($product['product_id'], $lang_id, $order_info['customer_group_id']);
          
          $attribute_data = '';
          $attribute_group_data = array();
          
          foreach ($product_attributes as $attribute_group) {
            if (!empty($attribute_group['attribute'])) {
              $attribute_data .= '<b>'.$attribute_group['name'].'</b><br/>';
              
              foreach ($attribute_group['attribute'] as $attribute) {
                $attribute_data .= '- '.$attribute['name'].': '.$attribute['text'].'<br/>';
                
                if (isset($attribute_group_data[$attribute_group['name']])) {
                  $attribute_group_data[$attribute_group['name']] .= '- '.$attribute['name'].': '.$attribute['text'].'<br/>';
                } else {
                  $attribute_group_data[$attribute_group['name']] = '- '.$attribute['name'].': '.$attribute['text'].'<br/>';
                }
                
                if (in_array('attributes', $prod_options)) {
                  $option_data[] = array(
                    'name'  => $attribute['name'],
                    'value' => $attribute['text']
                  );
                }
              }
            }
          }
        }
        
        // get customer group for display in template
        if ($order_info['customer_group_id'] !== 0) {
          if (defined('PDF_INVOICE_ADMIN')) {
            $this->load->model('customer/customer_group');
            $customer_group = $this->model_customer_customer_group->getCustomerGroup($order_info['customer_group_id']);
          } else {
            $this->load->model('account/customer_group');
            $customer_group = $this->model_account_customer_group->getCustomerGroup($order_info['customer_group_id']);
          }
          
          if (!empty($customer_group)) {
            $data['customer_group'] = $customer_group['name'];
          } else {
            $data['customer_group'] = '';
          }
        }

        $extra_product_data = array();
        
        $extra_columns = array();
        if (in_array('attribute_group', $orig_columns)) {
          $i = 0;
          $addExtraCols = false;
          foreach ($attribute_group_data as $group_name => $value) {
            if (!in_array('attribute_group_'.$i, $columns)) {
              $extra_columns[] = 'attribute_group_'.$i;
              $language->set('column_attribute_group_'.$i, $group_name);
              $addExtraCols = true;
            }
            
            $extra_product_data['attribute_group_'.$i] = $value;
            $i++;
          }
          
          if ($addExtraCols) {
           $col_key = array_search('attribute_group', $orig_columns);
           
           $columns = array_merge(array_slice($columns, 0, $col_key, true), $extra_columns, array_slice($columns, $col_key+1, count($columns)-$col_key, true));
          }
          //unset($columns[array_search('attribute_group', $columns)]);
        }
        
				if(in_array('weight', $prod_options) && $full_product['weight']) {
					$option_data[] = array(
						'name'  => $language->get('column_weight'),
						'value' => $this->weight->format($full_product['weight'], $full_product['weight_class_id'], $language->get('decimal_point'), $language->get('thousand_point'))
					);
				}
				
        $special_percent = '';
        if (!empty($full_product['price'])) {
          if ($full_product['price'] > 0) {
            $special_percent = round((1-($product['price']/$full_product['price']))*100);
          }
          $special_percent = $special_percent ? $special_percent.'%' : '';
        }
        
        // sort options
        usort($option_data, function($a, $b) { 
          $cmp = strnatcmp($a['name'], $b['name']);
          if ($cmp) return $cmp; 
          return strnatcmp($a['value'], $b['value']);
        });

				$product_data[] = array(
					'product_id'=> $product['product_id'],
					'image'		=> $full_product['image'],
					'name'		=> $product['name'],
					'model'		=> $product['model'],
					'description'		=> $full_product['description'],
					'manufacturer'=> $manufacturer,
					'attributes'		=> isset($attribute_data) ? $attribute_data : '',
					'option'		=> $option_data,
					'quantity'	=> $product['quantity'],
					'weight'		=> $full_product['weight'] ? $this->weight->format($full_product['weight'], $full_product['weight_class_id'], $language->get('decimal_point'), $language->get('thousand_point')) : null,
					'orig_price' => isset($full_product['price']) ? $this->currency->format($full_product['price'], $order_info['currency_code'], $order_info['currency_value']) : '',
					'price'		=> $this->currency->format($product['price'], $order_info['currency_code'], $order_info['currency_value']),
					'price_tax'	=> $this->currency->format($product['price'] + $product['tax'], $order_info['currency_code'], $order_info['currency_value']),
					'special_percent'	=> $special_percent,
					'tax'			=> $this->currency->format($product['tax'], $order_info['currency_code'], $order_info['currency_value']),
					'tax_total'	=> $this->currency->format($product['tax'] * $product['quantity'], $order_info['currency_code'], $order_info['currency_value']),
					'tax_rate'	=> ($product['price'] > 0) ? round($product['tax']  / abs($product['price']) * 1, 4) * 100 . '%' : '',
					'total'		=> $this->currency->format($product['total'], $order_info['currency_code'], $order_info['currency_value']),
					'total_tax'	=> $this->currency->format($product['total'] + ($this->config->get('pdf_invoice_total_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']),
          'orig_total'		=> $this->currency->format($full_product['price'] * $product['quantity'], $order_info['currency_code'], $order_info['currency_value']),
					'orig_total_tax'	=> $this->currency->format($full_product['price'] * $product['quantity'] + ($this->config->get('pdf_invoice_total_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']),
					'mpn'		=> $full_product['mpn'],
					'isbn'		=> $full_product['isbn'],
					'location'	=> $full_product['location'],
					'sku'			=> !empty($product['sku']) ? $product['sku'] : $full_product['sku'],
					'upc'			=> !empty($product['upc']) ? $product['upc'] : $full_product['upc'],
					'ean'			=> $full_product['ean'],
					'barcode'	=> isset($full_product['barcode']) ? $full_product['barcode'] : '',
					'sort_order'	=> isset($full_product['sort_order']) ? $full_product['sort_order'] : '',
				) + $extra_product_data;
			}
			
      // sort products by sort order
      //usort($data['product_data'], array($this, 'cmp'));
      
      $data['total_weight'] = $this->weight->format($data['total_weight'], $this->config->get('config_weight_class_id'), $language->get('decimal_point'), $language->get('thousand_point'));
      
			$voucher_data = $vouchers = array();
			
			// 1.5.0 - 1.5.1 compatibility
      if (version_compare(VERSION, '1.5.2', '>=')) {
        $vouchers = $this->{$order_model2}->getOrderVouchers($order_id);
      }

			foreach ($vouchers as $voucher) {
				$voucher_data[] = array(
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value'])			
				);
			}
				
				$totals = $this->{$order_model2}->getOrderTotals($order_id);
				$total_data = array();
			
			// strip html tags in total desc, and apply taxes
			foreach ($totals as $total) {
				if (false && $this->config->get('pdf_invoice_coupon') && ($total['code'] == 'coupon')) {
          $total_data[] = array(
							'code' =>  $total['code'],
							'title' => 'Discount',
							'text'  => $this->currency->format($this->getTax($total['value'], $this->config->get('pdf_invoice_totals_tax'), $order_info), $order_info['currency_code'], $order_info['currency_value']),
						);
				} else if ($this->config->get('pdf_invoice_totals_tax') && (!in_array($total['code'], array('total', 'tax')))) {
						$total_data[] = array(
							'code' =>  $total['code'],
							'title' =>  strip_tags(html_entity_decode($total['title'], ENT_QUOTES, 'UTF-8')),
							'text'  => $this->currency->format($this->getTax($total['value'], $this->config->get('pdf_invoice_totals_tax'), $order_info), $order_info['currency_code'], $order_info['currency_value']),
						);
				} else {
					$total_data[] = array(
            'code' =>  $total['code'],
						'title' =>  strip_tags(html_entity_decode($total['title'], ENT_QUOTES, 'UTF-8')),
						'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
					);
				}
			}
			
      if (in_array($order_info['order_status_id'], (array) $this->config->get('pdf_invoice_refund'))) {
        $data['title'] = $language->get('text_refund');
        
        $total_data[] = array(
          'code'  => 'refund',
          'title' => $language->get('text_total_refund'),
          'text'  => $this->currency->format('-'.$order_info['total'], $order_info['currency_code'], $order_info['currency_value']),
        );
      }
      
			$due_date = '';
      
			if (isset($order_info['date_invoice']) && $order_info['date_invoice']) {
				$due_date = $date_function($date_format, strtotime($order_info['date_invoice']));
			} elseif ($this->config->get('pdf_invoice_duedate') != '') {
				$due_date = $date_function($date_format, strtotime($order_info['date_added'].' + '.$this->config->get('pdf_invoice_duedate').' day'));
			}
			
      if (strpos($order_info['payment_method'], '<img') !== false) {
        if (!preg_match('/<img(.+?)src="(.+?)"(.*?)\/>/', $order_info['payment_method'])) {
          $order_info['payment_method'] = strstr($order_info['payment_method'], '<img', true);
        }
      }
      
      if (strpos($order_info['shipping_method'], '<img') !== false) {
        if (!preg_match('/<img (.*?)src="(.+?)"(.*?)\/>/', $order_info['shipping_method'])) {
          $order_info['shipping_method'] = strstr($order_info['shipping_method'], '<img', true);
        }
      }
      
      // compat with xpayment
      if (strpos($order_info['payment_code'], 'xpayment') !== false) {
        $xpay_id = substr($order_info['payment_code'], 8);

        $this->load->model('extension/payment/xpayment');
        if(property_exists($this->model_extension_payment_xpayment, 'getMethodDataByID')){
          $xpayment = $this->model_extension_payment_xpayment->getMethodDataByID($xpay_id);
          $order_info['payment_method'] = $xpayment['name'][$lang_id];
        } else {
          $xpayment = $this->model_extension_payment_xpayment->getDataByTabId($xpay_id);
          $xpayment_data = unserialize(base64_decode($xpayment['method_data']));
          $order_info['payment_method'] = $xpayment_data['name'][$lang_id];
        }
      }
			
			$data = array_merge($data, array(
				'order_id'	         => $order_id,
				'invoice_no'         => $order_info['invoice_no'],
				'invoice_prefix'     => $order_info['invoice_prefix'],
				'date_added'         => $date_function($date_format, strtotime($order_info['date_added'])),
				'date_due'         	 => $due_date,
				'store_name'         => $order_info['store_name'],
				'store_url'          => rtrim($order_info['store_url'], '/'),
				'store_address'      => nl2br($store_address),
				'store_email'        => $store_email,
				'store_telephone'    => $store_telephone,
				'store_fax'          => $store_fax,
				'email'              => $order_info['email'],
				'telephone'          => $order_info['telephone'],
				'shipping_address'   => $shipping_address,
				'shipping_method'    => strip_tags($order_info['shipping_method']),
				'payment_address'    => $payment_address,
				'payment_company_id' => isset($order_info['payment_company_id']) ? $order_info['payment_company_id'] : '',
				'payment_tax_id'     => isset($order_info['payment_tax_id']) ? $order_info['payment_tax_id'] : '',
				'payment_method'     => strip_tags($order_info['payment_method']),
				'products'           => $product_data,
				'vouchers'           => $voucher_data,
				'totals'             => $total_data,
				//'comment'          => nl2br($order_info['comment'])
			));
		}
		
      $data['watermark'] = '';
      
      if ($this->config->get('pdf_invoice_watermark')) {
        $data['watermark'] = DIR_IMAGE . $this->config->get('pdf_invoice_watermark');
      }
    
			if ($type == 'packingslip') {
        $tpl = !empty($this->request->get['tpl']) ? $this->request->get['tpl'] : $this->config->get('pdf_invoice_sliptemplate');
        
				if (file_exists(DIR_TEMPLATE . $template_path . '/default/template/pdf/packingslip/' . $tpl . '.tpl')) {
					$tpl_file = $template_path . '/default/template/pdf/packingslip/' . $tpl . '.tpl';
				}else{
					$tpl_file = $template_path . '/default/template/pdf/packingslip/default.tpl';
				}
      } else if($type == 'recurring') {
        $tpl_file = $template_path . '/default/template/pdf/recurring/default.tpl';
      } else if($type == 'return') {
        $tpl_file = $template_path . '/default/template/pdf/return/default.tpl';
			} else {
        if (!empty($this->request->get['tpl'])) {
          $tpl = $this->request->get['tpl'];
        } else {
          if (!isset($order_info['customer_group_id'])) {
            $query = $this->db->query("SELECT customer_group_id FROM " . DB_PREFIX . "order oh WHERE order_id = '" . (int)$order_info['order_id'] . "' LIMIT 1")->row;
            $order_info['customer_group_id'] = isset($query['customer_group_id']) ? $query['customer_group_id'] : 0;
          }
          
          if ($this->config->get('pdf_invoice_template_group_'.$order_info['customer_group_id'])) {
            $tpl = $this->config->get('pdf_invoice_template_group_'.$order_info['customer_group_id']);
          } else {
            $tpl = $this->config->get('pdf_invoice_template');
          }
        }
        
				if (file_exists(DIR_TEMPLATE . $template_path . '/default/template/pdf/' . $tpl . '.tpl')) {
					$tpl_file = $template_path . '/default/template/pdf/' . $tpl . '.tpl';
				} else {
					$tpl_file = $template_path . '/default/template/pdf/default.tpl';
				}
			}
			
      if (version_compare(VERSION, '3', '>=')) {
        $template = new Template('template', $this->registry);
        foreach ($data as $key => $value) {
          $template->set($key, $value);
        }
        $tpl_file = pathinfo($tpl_file, PATHINFO_DIRNAME) . '/' . pathinfo($tpl_file, PATHINFO_FILENAME);
        
        $rf = new ReflectionMethod('Template', 'render');
          
        if ($rf->getNumberOfParameters() > 2) {
          $pdf_html .= $template->render($tpl_file, $this->registry, false);
        } else {
          $pdf_html .= $template->render($tpl_file, false);
        }
      } else if (version_compare(VERSION, '2.2', '>=')) {
        $template = new Template(version_compare(VERSION, '2.3', '>=') ? 'php': 'basic');
        foreach ($data as $key => $value) {
          $template->set($key, $value);
        }
        $pdf_html .= $template->render($tpl_file, null); // null is for compatibility with fastor theme
      } elseif (method_exists($this->load, 'view')) {
				$pdf_html .= $this->load->view($tpl_file, $data);
			} else {
				$template = new Template();
				$template->data = &$data;
				$pdf_html .= $template->fetch($tpl_file);
			}
			
			// tags replacement
			$replace = $conditions = array();
      $replace[str_replace('https://', 'http://', $http_image)] = DIR_IMAGE;
			$replace[$http_image] = DIR_IMAGE;
			if ($order_info['store_url']) {
        $replace[$order_info['store_url'] . 'image/'] = DIR_IMAGE;
      }
      if ($this->config->get('config_url')) {
        $replace[$this->config->get('config_url') . 'image/'] = DIR_IMAGE;
      }
			$replace['{page_number}'] = '{PAGENO}/{nbpg}';
		
      // order info tags
      if(!empty($order_info['tracking_url'])) {
        $replace['{tracking_link}'] = '<a href="' . $order_info['tracking_url'] . '">' . $order_info['tracking_url'] . '</a>';
      }
      
      foreach ($order_info as $k => $v) {
        if ($k == 'payment_custom_field' || $k == 'shipping_custom_field'  || $k == 'custom_field') {
          if (is_array($v)) {
            foreach ($v as $cfid => $cfv) {
              //$custom_field = $this->{$custom_field_model}->getCustomField($v);
              $replace['{'.$k.'.'.$cfid.'}'] = is_string($cfv) ? $cfv : '';
            }
          }
        } else if (is_string($v) || !$v) {
          $replace['{'.$k.'}'] = is_string($v) ? $v : '';
        }
      }
      
      $replace['{order_url}'] = $basepath . 'index.php?route=account/order/info&order_id=' . $order_info['order_id'];
      
      if (strpos($pdf_html, '{order_history_comment}') !== false) {
        $query = $this->db->query("SELECT oh.comment FROM " . DB_PREFIX . "order_history oh WHERE oh.order_id = '" . (int)$order_id . "' AND oh.comment != '' ORDER BY oh.date_added DESC LIMIT 1")->row;
        $replace['{order_history_comment}'] = isset($query['comment']) ? $query['comment'] : '';
        $conditions['order_history_comment'] = !empty($query['comment']);
      }
      
      if (strpos($pdf_html, '{order_history}') !== false) {
        $query = $this->db->query("SELECT date_added, os.name AS status, oh.comment FROM " . DB_PREFIX . "order_history oh LEFT JOIN " . DB_PREFIX . "order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int)$order_id . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oh.date_added")->rows;
        $oh = '<table class="list">';
        $oh .= '<thead><tr><td>'.$language->get('text_date').'</td><td>'.$language->get('text_comment').'</td><td>'.$language->get('text_status').'</td></tr></thead>';
        foreach ($query as $row) {
          $oh .= '<tr><td>'.$row['date_added'].'</td><td>'.$row['comment'].'</td><td>'.$row['status'].'</td></tr>';
          
        }
        $oh .= '</table>';
        
        $replace['{order_history}'] = $oh;
      }
      
      $replace['{total}'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value']);
      
      // number to word converter
      if (strpos($pdf_html, '{total_words}') !== false) {
        if (!is_file(DIR_SYSTEM . 'library/numbers_words/NumbersWords.php')) die('Please update pdf invoice libraries package to at least v1.2 in order to use {number_words} tag');
        
        require_once(DIR_SYSTEM . 'library/numbers_words/NumbersWords.php');
        
        $nw = new Numbers_Words();
        $replace['{total_words}'] = $nw->toCurrency($order_info['total'], substr($lang_code, 0, 2), $order_info['currency_code']);
      }
      
      if (strpos($pdf_html, '{customer_fax}') !== false) {
        if (version_compare(VERSION, '2.1', '>=')) {
          $this->load->model('customer/customer');
          $customer = $this->model_customer_customer->getCustomer($order_info['customer_id']);
        } else {
          $this->load->model('sale/customer');
          $customer = $this->model_sale_customer->getCustomer($order_info['customer_id']);
        }
        
        $replace['{customer_fax}'] = !empty($customer['fax']) ? $data['text_fax'] . ' ' . $customer['fax'] : '';
      }
      
      #custom_tags
      if (strpos($pdf_html, '{admin_user}') !== false) {
          $this->load->model('user/user');
          $user = $this->model_user_user->getUser($_SESSION['user_id']);
      
          $replace['{admin_user}'] = $user['firstname'] . ' ' . $user['lastname'];
        }
      foreach ($conditions as $k => $v) {
        if ($v) {
          $replace['[if_'.$k.']'] = $replace['[/if_'.$k.']'] = '';
        } else {
          $replace['[if_not_'.$k.']'] = $replace['[/if_not_'.$k.']'] = '';
        }
      }
      
			$pdf_html = str_replace(array_keys($replace), array_values($replace), $pdf_html);
      
      $pdf_html = preg_replace('/\[if_([\-\.\:\w]+)\](.*)\[\/if_([\-\.\:\w]+)\]/isU', '', $pdf_html);
      $pdf_html = preg_replace('/\{(payment_custom_field|shipping_custom_field)\.\d+\}/isU', '', $pdf_html);
      
      if (!is_file($data['logo'])) {
        $pdf_html = str_replace(DIR_IMAGE, $http_image, $pdf_html); // image http mode if path mode is not working
      }
		}
    
    if (file_exists(DIR_SYSTEM . 'library/mpdf_8/vendor/autoload.php')) {
      require_once(DIR_SYSTEM . 'library/mpdf_8/vendor/autoload.php');
      $mpdfVersion = 8;
    } else if (!defined('mPDF_VERSION')) {
      require_once(DIR_SYSTEM . 'library/mpdf/mpdf.php');
      $mpdfVersion = 6;
    }
    
		$display_errors = ini_get('display_errors'); 
    
		if($mode == 'backup'){
      $pageFormat = $this->config->get('pdf_invoice_backup_size') ? $this->config->get('pdf_invoice_backup_size') : 'A4';
      
			$backupPath = $this->getBackupPath($order_id);
				
			if (is_writable(dirname($backupPath))) {
				// @perf: check if backup format = source format, if yes just use copy instead of regenerate
        if ($mpdfVersion >= 8) { // v8
          $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => $pageFormat,
            //'orientation' => 'L'
          ]);
          $mpdf->img_dpi = 150;
          
          if ($type != 'return' && $data['watermark']) {
            $mpdf->showWatermarkImage = true;
            $mpdf->SetWatermarkImage($data['watermark']);
          }
          
          $mpdf->WriteHTML($pdf_html);
          $mpdf->Output($backupPath, 'F');
        } else {
          ini_set('display_errors', 0);
          set_error_handler('is_null', 0);
          $mpdf = new mPDF('', $pageFormat);
          $mpdf->ignore_invalid_utf8 = true;
          $mpdf->autoScriptToLang = true;
          $mpdf->autoLangToFont = true;
          $mpdf->setAutoBottomMargin = 'stretch';
          $mpdf->img_dpi = 150;
          //$mpdf->setBasePath($basepath); // make file image in some cases
          $mpdf->WriteHTML($pdf_html);
          $mpdf->Output($backupPath, 'F');
          restore_error_handler();
          ini_set('display_errors', $display_errors);
          //copy($temp_pdf, $backup_pdf);
        }
			}
			return;
		}
		
		$pageFormat = $this->config->get('pdf_invoice_size_' . $lang_id) ? $this->config->get('pdf_invoice_size_' . $lang_id) : 'A4';
		
    if(false && $type == 'packingslip') {
      $pageFormat = array(133, 209);
    }
    
    
    
		//set_error_handler('pdfinv_log_err');
		//$mpdf = new mPDF('', $pageFormat);
    if ($mpdfVersion >= 8) { // v8
      $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => $pageFormat,
        //'orientation' => 'L'
      ]);
      $mpdf->img_dpi = 150;
      
      if ($type != 'return' && $data['watermark']) {
        $mpdf->showWatermarkImage = true;
        $mpdf->SetWatermarkImage($data['watermark']);
      }
      
      $mpdf->WriteHTML($pdf_html);
    } else {
      ini_set('display_errors', 0);
  		set_error_handler('is_null', 0);
  		//set_error_handler('pdfinv_log_err');
  		$mpdf = new mPDF('', $pageFormat);
  		$mpdf->ignore_invalid_utf8 = true;
  		$mpdf->autoScriptToLang = true;
  		$mpdf->autoLangToFont = true;
      $mpdf->setAutoBottomMargin = 'stretch';
      if(false && $type == 'packingslip') {
        $mpdf->setAutoBottomMargin = false;
      }
  		$mpdf->img_dpi = 150;
  		//$mpdf->setBasePath($basepath); // make file image in some cases
      $mpdf->showWatermarkImage = true;
      if ($type != 'return') {
        $mpdf->SetWatermarkImage($data['watermark']);
      }
  		//$mpdf->SetHtmlFooter('<p>Test footer</p>');
  		$mpdf->WriteHTML($pdf_html);
		}

		$pdfFilename = array();
		
		if($mode == 'file')
		{
      if($type == 'return') {
				$pdfFilename[] = ($language->get('file_return') != 'file_return') ? $language->get('file_return') : 'return';
				$pdfFilename[] = !empty($return_info['return_id']) ? $return_info['return_id'] : '';
      } else {
        if($type == 'packingslip')
          $pdfFilename[] = 'Packing-slip';
        elseif($type == 'return')
          $pdfFilename[] = ($language->get('file_return') != 'file_return') ? $language->get('file_return') : 'return';
        elseif($this->config->get('pdf_invoice_filename_prefix') && $this->config->get('pdf_invoice_filename_'.$lang_id))
          $pdfFilename[] = str_replace('{email}', $order_info['email'], trim($this->config->get('pdf_invoice_filename_'.$lang_id)));
        if($this->config->get('pdf_invoice_filename_invnum') && $order_info['invoice_no'])
          $pdfFilename[] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
        if($this->config->get('pdf_invoice_filename_ordnum'))
          $pdfFilename[] = $order_id;
      }
      
			$pdfFilename = implode('-', $pdfFilename) ? implode('-', $pdfFilename).'.pdf' : 'invoice.pdf';
      $pdfFilename = str_replace('/', '-', $pdfFilename);
			
      $temp_pdf = DIR_CACHE . $pdfFilename;

			$mpdf->Output($temp_pdf, 'F');
      if ($mpdfVersion < 8) { 
      restore_error_handler();
      ini_set('display_errors', $display_errors);
      }
			return($temp_pdf);
		}
		else
		{
			if($type == 'return') {
				$pdfFilename[] = ($language->get('file_return') != 'file_return') ? $language->get('file_return') : 'return';
				$pdfFilename[] = !empty($return_info['return_id']) ? $return_info['return_id'] : '';
      } else {
        if($type == 'packingslip')
          $pdfFilename[] = 'Packing-slip';
        elseif($type == 'return')
          $pdfFilename[] = ($language->get('file_return') != 'file_return') ? $language->get('file_return') : 'return';
        elseif($this->config->get('pdf_invoice_filename_prefix') && $this->config->get('pdf_invoice_filename_'.$lang_id))
          $pdfFilename[] = str_replace('{email}', $order_info['email'], trim($this->config->get('pdf_invoice_filename_'.$lang_id)));
        if($this->config->get('pdf_invoice_filename_invnum') && $order_info['invoice_no'])
          $pdfFilename[] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
        if($this->config->get('pdf_invoice_filename_ordnum'))
          $pdfFilename[] = $order_id;
      }
      
      $pdfFilename = implode('-', $pdfFilename) ? implode('-', $pdfFilename).'.pdf' : 'invoice.pdf';
      $pdfFilename = str_replace('/', '-', $pdfFilename);
      
			if (!$this->config->get('pdf_invoice_display_mode')) {
				$mpdf->Output($pdfFilename, 'D'); // I:inline, D:download, F:save, S:string
				exit;
			} else if ($this->config->get('pdf_invoice_display_mode') == 'view') {
        $mpdf->Output($pdfFilename, 'I');
				exit;
			} else if ($this->config->get('pdf_invoice_display_mode') == 'html') {
        $pdf_html = str_replace(DIR_IMAGE, $http_image, $pdf_html); // html display
				echo $pdf_html; exit;
			}
		}
	}
	
	private function getProductImage($product_id) {
		$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "' LIMIT 1");
		return isset($query->row['image']) ? $query->row['image'] : '';
	}
	
	private function getManufacturer($manufacturer_id) {
		if(!$manufacturer_id) return '';
		
		$query = $this->db->query("SELECT DISTINCT name FROM " . DB_PREFIX . "manufacturer WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return isset($query->row['name']) ? $query->row['name'] : '';
	}
	
	public function getTax($value, $tax_class_id, $order_info) {
		$tax_rates = array();
		
		$customer_group_id = $order_info['customer_group_id'];
		
		
		foreach (array('shipping', 'payment', 'store') as $tax_mode) {
			if ($tax_mode == 'store') {
				$country_id = $this->config->get('config_country_id');
				$zone_id = $this->config->get('config_zone_id');
			} else {
				$country_id = $order_info[$tax_mode.'_country_id'];
				$zone_id = $order_info[$tax_mode.'_zone_id'];
			}
			
			$tax_query = $this->db->query("SELECT tr2.tax_rate_id, tr2.name, tr2.rate, tr2.type, tr1.priority FROM " . DB_PREFIX . "tax_rule tr1 LEFT JOIN " . DB_PREFIX . "tax_rate tr2 ON (tr1.tax_rate_id = tr2.tax_rate_id) INNER JOIN " . DB_PREFIX . "tax_rate_to_customer_group tr2cg ON (tr2.tax_rate_id = tr2cg.tax_rate_id) LEFT JOIN " . DB_PREFIX . "zone_to_geo_zone z2gz ON (tr2.geo_zone_id = z2gz.geo_zone_id) LEFT JOIN " . DB_PREFIX . "geo_zone gz ON (tr2.geo_zone_id = gz.geo_zone_id) WHERE tr1.tax_class_id = '" . (int)$tax_class_id . "' AND tr1.based = '" . $tax_mode . "' AND tr2cg.customer_group_id = '" . (int)$customer_group_id . "' AND z2gz.country_id = '" . (int)$country_id . "' AND (z2gz.zone_id = '0' OR z2gz.zone_id = '" . (int)$zone_id . "') ORDER BY tr1.priority ASC");

			foreach ($tax_query->rows as $result) {
				$tax_rates[$result['tax_rate_id']] = array(
					'tax_rate_id' => $result['tax_rate_id'],
					//'name'        => $result['name'],
					'rate'        => $result['rate'],
					'type'        => $result['type'],
					//'priority'    => $result['priority']
				);
			}
		}

		$tax_rate_data = array();

		foreach ($tax_rates as $tax_rate) {
			if (isset($tax_rate_data[$tax_rate['tax_rate_id']])) {
				$amount = $tax_rate_data[$tax_rate['tax_rate_id']]['amount'];
			} else {
				$amount = 0;
			}

			if ($tax_rate['type'] == 'F') {
				$amount += $tax_rate['rate'];
			} elseif ($tax_rate['type'] == 'P') {
				$amount += ($value / 100 * $tax_rate['rate']);
			}

			$tax_rate_data[$tax_rate['tax_rate_id']] = array(
				'amount'      => $amount
			);
		}

		$amount = 0;
		
		foreach ($tax_rate_data as $tax_rate) {
			$amount += $tax_rate['amount'];
		}

		return $value + $amount;
	}
	
	public function getBackupPath($order_id) {
    
    if (defined('PDF_INVOICE_ADMIN')) {
			$order_model = 'model_sale_order';
		} else {
			$order_model = 'model_checkout_order';
		}
    
    $order_info = $this->{$order_model}->getOrder($order_id);
    
    $backup_path = DIR_SYSTEM . '../' . $this->config->get('pdf_invoice_backup_folder') . '/';
    
    $structure = $this->config->get('pdf_invoice_backup_structure');
    
    if ($structure) {
      $structure = date($structure) . '/';
    }
    
    if (!file_exists($backup_path . $structure) && is_writable($backup_path)) {
      mkdir($backup_path . $structure, 0777, true);
    }
    
    $pdfFilename = array();
    
    if($this->config->get('pdf_invoice_backup_prefix'))
      $pdfFilename[] = trim($this->config->get('pdf_invoice_backup_prefix'));
    if($this->config->get('pdf_invoice_backup_invnum') && $order_info['invoice_no'])
      $pdfFilename[] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
    if($this->config->get('pdf_invoice_backup_ordnum') || (!$this->config->get('pdf_invoice_backup_ordnum') && !$order_info['invoice_no']) || (!$this->config->get('pdf_invoice_backup_ordnum') && !$this->config->get('pdf_invoice_backup_invnum')))
      $pdfFilename[] = $order_id;
    $pdfFilename = implode('-', $pdfFilename) . '.pdf';
    
    return $backup_path . $structure . '/' . $pdfFilename;
  }
  
	private function cmp($a, $b) {
		if ($a['sort_order'] == $b['sort_order']) return 0;
		return ($a['sort_order'] < $b['sort_order']) ? -1 : 1;
	}
  
  public function getProductAttributes($product_id, $lang, $customer_group_id) {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.product_id = '" . (int)$product_id . "' AND agd.language_id = '" . (int)$lang . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

		foreach ($product_attribute_group_query->rows as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$lang . "' AND pa.language_id = '" . (int)$lang . "' ORDER BY a.sort_order, ad.name");

			foreach ($product_attribute_query->rows as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name'],
					'text'         => $product_attribute['text']
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['name'],
				'attribute'          => $product_attribute_data
			);
		}

		return $product_attribute_group_data;
	}
}
?>
<?php
class ModelExtensionModuleAnchorPrice extends Model {
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_anchor_price` (
			`product_id` INT(11) UNSIGNED NOT NULL,
			`anchor_price` DECIMAL(15,4) NOT NULL DEFAULT '0.0000',
			`reference_date` DATE DEFAULT NULL,
			`date_added` DATETIME NOT NULL,
			`date_modified` DATETIME NOT NULL,
			PRIMARY KEY (`product_id`),
			KEY `reference_date` (`reference_date`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
	}

	public function getProductAnchorPrice($product_id) {
		$query = $this->db->query("SELECT `product_id`, `anchor_price`, `reference_date` FROM `" . DB_PREFIX . "product_anchor_price` WHERE `product_id` = '" . (int)$product_id . "' LIMIT 1");

		return $query->row;
	}

	public function setProductAnchorPrice($product_id, $anchor_price, $reference_date) {
		$product_id = $this->normaliseProductId($product_id);
		$anchor_price = $this->normalisePrice($anchor_price);
		$reference_date = $this->normaliseDate($reference_date);

		if ($product_id === false || $anchor_price === false || $reference_date === false) {
			return false;
		}

		if ($anchor_price === '' && $reference_date === '') {
			$this->deleteProductAnchorPrice($product_id);
			return true;
		}

		if ($anchor_price === '' || $reference_date === '') {
			return false;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "product_anchor_price` SET
			`product_id` = '" . $product_id . "',
			`anchor_price` = '" . $this->db->escape($anchor_price) . "',
			`reference_date` = '" . $this->db->escape($reference_date) . "',
			`date_added` = NOW(),
			`date_modified` = NOW()
			ON DUPLICATE KEY UPDATE
			`anchor_price` = VALUES(`anchor_price`),
			`reference_date` = VALUES(`reference_date`),
			`date_modified` = NOW()");

		return true;
	}

	public function setProductAnchorPrices(array $rows) {
		$changes = array();

		foreach ($rows as $row) {
			$product_id = isset($row['product_id']) ? $this->normaliseProductId($row['product_id']) : false;
			$anchor_price = isset($row['anchor_price']) ? $this->normalisePrice($row['anchor_price']) : false;
			$reference_date = isset($row['reference_date']) ? $this->normaliseDate($row['reference_date']) : false;

			if ($product_id === false || $anchor_price === false || $reference_date === false) {
				return false;
			}

			if (($anchor_price === '') !== ($reference_date === '')) {
				return false;
			}

			// The last CSV occurrence for a product wins inside a batch, matching
			// sequential import semantics without duplicate-key conflicts.
			$changes[$product_id] = array(
				'product_id' => $product_id,
				'anchor_price' => $anchor_price,
				'reference_date' => $reference_date
			);
		}

		if (!$changes) {
			return true;
		}

		$delete_ids = array();
		$values = array();

		foreach ($changes as $change) {
			if ($change['anchor_price'] === '' && $change['reference_date'] === '') {
				$delete_ids[] = (int)$change['product_id'];
			} else {
				// Keep validated fixed-point strings intact; a float cast can round
				// DECIMAL(15,4) boundary values beyond the database column range.
				$values[] = "('" . (int)$change['product_id'] . "', '" . $this->db->escape($change['anchor_price']) . "', '" . $this->db->escape($change['reference_date']) . "', NOW(), NOW())";
			}
		}

		try {
			$this->db->query('START TRANSACTION');

			if ($delete_ids) {
				$this->db->query("DELETE FROM `" . DB_PREFIX . "product_anchor_price` WHERE `product_id` IN (" . implode(',', $delete_ids) . ")");
			}

			if ($values) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "product_anchor_price`
					(`product_id`, `anchor_price`, `reference_date`, `date_added`, `date_modified`) VALUES " . implode(',', $values) . "
					ON DUPLICATE KEY UPDATE
					`anchor_price` = VALUES(`anchor_price`),
					`reference_date` = VALUES(`reference_date`),
					`date_modified` = NOW()");
			}

			$this->db->query('COMMIT');
		} catch (Exception $exception) {
			try {
				$this->db->query('ROLLBACK');
			} catch (Exception $rollback_exception) {
				// Preserve the original database failure in the log.
			}

			$this->log->write('Anchor price batch save failed: ' . $exception->getMessage());
			return false;
		}

		return true;
	}

	public function deleteProductAnchorPrice($product_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "product_anchor_price` WHERE `product_id` = '" . (int)$product_id . "'");
	}

	public function findProductId(array $row) {
		$matches = $this->findProductIds(array($row));

		return isset($matches[0]) ? $matches[0] : 0;
	}

	public function findProductIds(array $rows) {
		$resolved = array();
		$product_id_requests = array();
		$sku_requests = array();
		$model_requests = array();

		foreach ($rows as $index => $row) {
			$resolved[$index] = 0;

			if (isset($row['product_id']) && trim((string)$row['product_id']) !== '') {
				$product_id = $this->normaliseProductId($row['product_id']);

				if ($product_id === false) {
					$resolved[$index] = -2;
				} else {
					$product_id_requests[$product_id] = true;
				}

				continue;
			}

			if (isset($row['sku']) && trim((string)$row['sku']) !== '') {
				$sku_requests[trim((string)$row['sku'])] = true;
			}

			if (isset($row['model']) && trim((string)$row['model']) !== '') {
				$model_requests[trim((string)$row['model'])] = true;
			}
		}

		$product_ids = array();
		$sku_matches = array();
		$model_matches = array();

		if ($product_id_requests) {
			$query = $this->db->query("SELECT `product_id` FROM `" . DB_PREFIX . "product` WHERE `product_id` IN (" . implode(',', array_keys($product_id_requests)) . ")");

			foreach ($query->rows as $result) {
				$product_ids[(int)$result['product_id']] = (int)$result['product_id'];
			}
		}

		if ($sku_requests) {
			$query = $this->db->query("SELECT `product_id`, `sku` FROM `" . DB_PREFIX . "product` WHERE `sku` IN (" . $this->quoteValues(array_keys($sku_requests)) . ") ORDER BY `product_id` ASC");

			foreach ($query->rows as $result) {
				$sku = $this->identifierKey($result['sku']);

				if (!isset($sku_matches[$sku])) {
					$sku_matches[$sku] = array();
				}

				$sku_matches[$sku][] = (int)$result['product_id'];
			}
		}

		if ($model_requests) {
			$query = $this->db->query("SELECT `product_id`, `model` FROM `" . DB_PREFIX . "product` WHERE `model` IN (" . $this->quoteValues(array_keys($model_requests)) . ") ORDER BY `product_id` ASC");

			foreach ($query->rows as $result) {
				$model = $this->identifierKey($result['model']);

				if (!isset($model_matches[$model])) {
					$model_matches[$model] = array();
				}

				$model_matches[$model][] = (int)$result['product_id'];
			}
		}

		foreach ($rows as $index => $row) {
			if ($resolved[$index] === -2) {
				continue;
			}

			if (isset($row['product_id']) && trim((string)$row['product_id']) !== '') {
				$product_id = $this->normaliseProductId($row['product_id']);
				$resolved[$index] = isset($product_ids[$product_id]) ? $product_ids[$product_id] : 0;
				continue;
			}

			$sku = isset($row['sku']) ? trim((string)$row['sku']) : '';
			$sku_key = $this->identifierKey($sku);

			if ($sku !== '' && isset($sku_matches[$sku_key])) {
				if (count($sku_matches[$sku_key]) === 1) {
					$resolved[$index] = $sku_matches[$sku_key][0];
				} else {
					$resolved[$index] = -1;
				}

				continue;
			}

			$model = isset($row['model']) ? trim((string)$row['model']) : '';
			$model_key = $this->identifierKey($model);

			if ($model !== '' && isset($model_matches[$model_key])) {
				$resolved[$index] = count($model_matches[$model_key]) === 1 ? $model_matches[$model_key][0] : -1;
			}
		}

		return $resolved;
	}

	public function normaliseProductId($value) {
		$value = trim((string)$value);

		// OpenCart 3 defines product.product_id as a signed INT. Validate the
		// complete token before casting so values such as "123abc" never target 123.
		if (!preg_match('/^[1-9][0-9]*$/D', $value)) {
			return false;
		}

		$maximum = '2147483647';

		if (strlen($value) > strlen($maximum) || (strlen($value) === strlen($maximum) && strcmp($value, $maximum) > 0)) {
			return false;
		}

		return (int)$value;
	}

	public function normalisePrice($value) {
		$value = trim((string)$value);

		if ($value === '') {
			return '';
		}

		$value = str_replace(array("\xc2\xa0", ' '), '', $value);
		$last_comma = strrpos($value, ',');
		$last_dot = strrpos($value, '.');

		if ($last_comma !== false && $last_dot !== false) {
			if ($last_comma > $last_dot) {
				$value = str_replace('.', '', $value);
				$value = str_replace(',', '.', $value);
			} else {
				$value = str_replace(',', '', $value);
			}
		} elseif ($last_comma !== false) {
			$value = str_replace(',', '.', $value);
		}

		if (!preg_match('/^\d+(?:\.\d{1,4})?$/', $value)) {
			return false;
		}

		$parts = explode('.', $value, 2);
		$whole = ltrim($parts[0], '0');
		$whole = ($whole === '') ? '0' : $whole;
		$fraction = isset($parts[1]) ? str_pad($parts[1], 4, '0') : '0000';

		if (strlen($whole) > 11 || ($whole === '0' && $fraction === '0000')) {
			return false;
		}

		return $whole . '.' . $fraction;
	}

	public function normaliseDate($value) {
		$value = trim((string)$value);

		if ($value === '') {
			return '';
		}

		$formats = array('Y-m-d', 'd.m.Y', 'd/m/Y');

		foreach ($formats as $format) {
			$date = DateTime::createFromFormat('!' . $format, $value);
			$errors = DateTime::getLastErrors();

			if ($date && ($errors === false || (!$errors['warning_count'] && !$errors['error_count']))) {
				return $date->format('Y-m-d');
			}
		}

		return false;
	}

	private function quoteValues(array $values) {
		$quoted = array();

		foreach ($values as $value) {
			$quoted[] = "'" . $this->db->escape((string)$value) . "'";
		}

		return implode(',', $quoted);
	}

	private function identifierKey($value) {
		$value = trim((string)$value);

		return function_exists('utf8_strtolower') ? utf8_strtolower($value) : strtolower($value);
	}
}

<?php
/**
 * Digital price list generator for OpenCart 3.0.3.8.
 *
 * Files are generated in DIR_STORAGE and exposed only through read-only catalog
 * routes. Both the current version and the retained archive are publicly readable.
 */
class Digital_pricelist {
	private $registry;
	private $db;
	private $config;
	private $tax;
	private $anchor_table_exists;
	private $history_table_exists;
	private $supplier_quantity_column_exists;

	public function __construct($registry) {
		$this->registry = $registry;
		$this->db = $registry->get('db');
		$this->config = $registry->get('config');
		$this->tax = $registry->get('tax');
	}

	/**
	 * Return the private storage path for a current feed.
	 *
	 * @param string $format xml|csv
	 * @return string
	 */
	public function getCurrentPath($format) {
		$format = strtolower((string)$format);

		if (!in_array($format, array('xml', 'csv'), true)) {
			throw new InvalidArgumentException('Unsupported digital price list format.');
		}

		return $this->getStorageDirectory() . 'current.' . $format;
	}

	/**
	 * Return the compliant download filename for the current version.
	 *
	 * @param string $format xml|csv
	 * @return string
	 */
	public function getCurrentFilename($format) {
		$format = strtolower((string)$format);
		$this->getCurrentPath($format);
		$metadata = $this->readCurrentMetadata();

		if (!empty($metadata['base_filename'])) {
			return $metadata['base_filename'] . '.' . $format;
		}

		$mtime = is_file($this->getCurrentPath($format)) ? (int)filemtime($this->getCurrentPath($format)) : time();

		return $this->buildArchiveBaseName($this->getNextArchiveNumber(), date('Ymd_His', $mtime)) . '.' . $format;
	}

	/**
	 * Return public archive metadata without exposing the physical storage path.
	 *
	 * @return array
	 */
	public function getArchives() {
		$this->ensureStorageDirectories();
		$archives = array();
		$files = glob($this->getArchiveDirectory() . '*.{xml,csv}', GLOB_BRACE);

		if (!$files) {
			return $archives;
		}

		usort($files, function($left, $right) {
			return (int)filemtime($right) - (int)filemtime($left);
		});

		foreach ($files as $file) {
			$filename = basename($file);

			if (!$this->isValidArchiveFilename($filename)) {
				continue;
			}

			$archives[] = array(
				'filename' => $filename,
				'format' => strtolower(pathinfo($filename, PATHINFO_EXTENSION)),
				'archived_at' => date('c', (int)filemtime($file)),
				'size' => (int)filesize($file)
			);
		}

		return $archives;
	}

	/**
	 * Resolve a listed archive filename to a private path.
	 *
	 * @param string $filename
	 * @return string|false
	 */
	public function getArchivePath($filename) {
		$filename = (string)$filename;

		if (!$this->isValidArchiveFilename($filename)) {
			return false;
		}

		$path = $this->getArchiveDirectory() . $filename;

		return is_file($path) ? $path : false;
	}

	/**
	 * Hold a shared publication lock while a public response is reading files.
	 *
	 * @return resource
	 */
	public function acquireReadLock() {
		return $this->acquirePublicationLock(LOCK_SH);
	}

	/**
	 * @param resource $lock
	 */
	public function releaseReadLock($lock) {
		$this->releasePublicationLock($lock);
	}

	/**
	 * Generate XML and CSV feeds in one pass through the product data.
	 *
	 * @return array
	 * @throws RuntimeException
	 */
	public function generate() {
		$this->ensureStorageDirectories();
		@set_time_limit(0);
		$this->prepareTaxCalculator();

		$started_at = microtime(true);
		$lock_path = $this->getStorageDirectory() . '.generate.lock';
		$lock = fopen($lock_path, 'c');

		if (!$lock) {
			throw new RuntimeException('Digital price list lock could not be opened.');
		}

		if (!flock($lock, LOCK_EX | LOCK_NB)) {
			fclose($lock);
			throw new RuntimeException('Digital price list generation is already in progress.');
		}

		$xml_temp = false;
		$csv_temp = false;
		$xml_handle = false;
		$csv_handle = false;
		$publication_lock = false;
		$product_count = 0;
		$generated_at = date('c');

		try {
			$currency = (string)$this->config->get('config_currency');
			$store_name = $this->decodeText($this->config->get('config_name'));
			$base_url = $this->getStoreUrl();
			$object_type = trim($this->decodeText($this->config->get('module_digital_pricelist_object_type')));
			$object_address = trim($this->decodeText($this->config->get('module_digital_pricelist_object_address')));
			$object_code = trim($this->decodeText($this->config->get('module_digital_pricelist_object_code')));

			if ($object_type === '' || $object_address === '' || $object_code === '') {
				throw new RuntimeException('Digital price list object type, address and code must be configured before generation.');
			}

			$xml_temp = tempnam($this->getStorageDirectory(), 'xml_');
			$csv_temp = tempnam($this->getStorageDirectory(), 'csv_');

			if (!$xml_temp || !$csv_temp) {
				throw new RuntimeException('Temporary price list files could not be created.');
			}

			$xml_handle = fopen($xml_temp, 'wb');
			$csv_handle = fopen($csv_temp, 'wb');

			if (!$xml_handle || !$csv_handle) {
				throw new RuntimeException('Temporary price list files could not be opened.');
			}

			$this->write($xml_handle, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
			$this->write(
				$xml_handle,
				'<digital_pricelist version="1.0" generated_at="' . $this->xml($generated_at) . '" currency="' . $this->xml($currency) . '">' . "\n"
			);
			$this->write($xml_handle, '  <store>' . $this->xml($store_name) . "</store>\n");
			$this->write($xml_handle, "  <object>\n");
			$this->write($xml_handle, '    <type>' . $this->xml($object_type) . "</type>\n");
			$this->write($xml_handle, '    <address>' . $this->xml($object_address) . "</address>\n");
			$this->write($xml_handle, '    <code>' . $this->xml($object_code) . "</code>\n");
			$this->write($xml_handle, "  </object>\n");
			$this->write($xml_handle, "  <products>\n");

			$this->writeCsvRow($csv_handle, array(
				'product_id',
				'product_code',
				'sku',
				'model',
				'name',
				'brand',
				'unit_of_measure',
				'unit_price',
				'barcode',
				'availability_code',
				'availability',
				'stock_status',
				'quantity',
				'supplier_quantity',
				'available_quantity',
				'regular_price',
				'current_price',
				'retail_price',
				'special_sale',
				'special_sale_type',
				'anchor_price',
				'anchor_reference_date',
				'currency',
				'url',
				'date_modified'
			));

			$last_product_id = 0;
			$batch_size = 500;

			do {
				$products = $this->getProductBatch($last_product_id, $batch_size);

				foreach ($products as $product) {
					$last_product_id = (int)$product['product_id'];
					$record = $this->normaliseProduct($product, $currency, $base_url);

					$this->writeXmlProduct($xml_handle, $record);
					$this->writeCsvRow($csv_handle, array_values($record));
					$product_count++;
				}
			} while (count($products) === $batch_size);

			$this->write($xml_handle, "  </products>\n</digital_pricelist>\n");

			if (!fflush($xml_handle) || !fflush($csv_handle)) {
				throw new RuntimeException('Digital price list files could not be flushed to disk.');
			}

			fclose($xml_handle);
			fclose($csv_handle);
			$xml_handle = false;
			$csv_handle = false;

			if (!is_file($xml_temp) || filesize($xml_temp) === 0 || !is_file($csv_temp) || filesize($csv_temp) === 0) {
				throw new RuntimeException('Generated digital price list is empty.');
			}

			$publication_lock = $this->acquirePublicationLock(LOCK_EX);

			try {
				$archived = $this->archiveCurrentFiles();
				$current_number = $this->getNextArchiveNumber();
				$current_base_name = $this->buildArchiveBaseName($current_number, date('Ymd_His'));
				$this->replaceCurrentFiles($xml_temp, $csv_temp, $current_number, $current_base_name, $generated_at);
				$xml_temp = false;
				$csv_temp = false;
				$this->cleanupArchives();
			} finally {
				$this->releasePublicationLock($publication_lock);
				$publication_lock = false;
			}

			$duration_ms = (int)round((microtime(true) - $started_at) * 1000);
			$this->recordRun('success', $product_count, $duration_ms, 'Generation completed.');

			return array(
				'generated' => true,
				'generated_at' => $generated_at,
				'product_count' => $product_count,
				'duration_ms' => $duration_ms,
				'xml' => $this->getCurrentPath('xml'),
				'csv' => $this->getCurrentPath('csv'),
				'xml_filename' => $current_base_name . '.xml',
				'csv_filename' => $current_base_name . '.csv',
				'archived' => $archived
			);
		} catch (Throwable $exception) {
			if (is_resource($xml_handle)) {
				fclose($xml_handle);
			}

			if (is_resource($csv_handle)) {
				fclose($csv_handle);
			}

			if ($xml_temp && is_file($xml_temp)) {
				@unlink($xml_temp);
			}

			if ($csv_temp && is_file($csv_temp)) {
				@unlink($csv_temp);
			}

			$this->recordRun(
				'error',
				$product_count,
				(int)round((microtime(true) - $started_at) * 1000),
				$exception->getMessage()
			);

			throw $exception;
		} finally {
			if (is_resource($publication_lock)) {
				$this->releasePublicationLock($publication_lock);
			}

			flock($lock, LOCK_UN);
			fclose($lock);
		}
	}

	/**
	 * Summary used by the administration screen.
	 *
	 * @return array
	 */
	public function getStatus() {
		$xml_path = $this->getCurrentPath('xml');
		$csv_path = $this->getCurrentPath('csv');
		$archive_files = glob($this->getArchiveDirectory() . '*.{xml,csv}', GLOB_BRACE);

		$metadata = $this->readCurrentMetadata();

		return array(
			'xml_exists' => is_file($xml_path),
			'csv_exists' => is_file($csv_path),
			'xml_size' => is_file($xml_path) ? (int)filesize($xml_path) : 0,
			'csv_size' => is_file($csv_path) ? (int)filesize($csv_path) : 0,
			'last_generated' => is_file($xml_path) ? date('Y-m-d H:i:s', (int)filemtime($xml_path)) : '',
			'archive_files' => is_array($archive_files) ? count($archive_files) : 0,
			'current_base_filename' => isset($metadata['base_filename']) ? $metadata['base_filename'] : '',
			'storage_directory' => $this->getStorageDirectory()
		);
	}

	private function getProductBatch($last_product_id, $limit) {
		$language_id = $this->getFeedLanguageId();
		$store_id = (int)$this->config->get('config_store_id');
		$customer_group_id = $this->getPublicCustomerGroupId();

		$unit_attribute_id = (int)$this->config->get('module_digital_pricelist_unit_attribute_id');
		$unit_price_attribute_id = (int)$this->config->get('module_digital_pricelist_unit_price_attribute_id');
		$supplier_quantity_select = $this->supplierQuantityColumnExists() ? 'p.suplierqty' : '0 AS suplierqty';
		$include_disabled = (bool)$this->config->get('module_digital_pricelist_include_disabled');
		$anchor_select = '0 AS anchor_price, NULL AS anchor_reference_date';
		$anchor_join = '';
		$unit_select = "'' AS unit_of_measure";
		$unit_price_select = "'' AS unit_price";

		if ($unit_attribute_id > 0) {
			$unit_select = "(SELECT pa.text FROM `" . DB_PREFIX . "product_attribute` pa WHERE pa.product_id = p.product_id AND pa.attribute_id = '" . $unit_attribute_id . "' AND pa.language_id = '" . $language_id . "' LIMIT 1) AS unit_of_measure";
		}

		if ($unit_price_attribute_id > 0) {
			$unit_price_select = "(SELECT pa.text FROM `" . DB_PREFIX . "product_attribute` pa WHERE pa.product_id = p.product_id AND pa.attribute_id = '" . $unit_price_attribute_id . "' AND pa.language_id = '" . $language_id . "' LIMIT 1) AS unit_price";
		}

		if ($this->anchorTableExists()) {
			$anchor_select = 'pap.anchor_price, pap.reference_date AS anchor_reference_date';
			$anchor_join = ' LEFT JOIN `' . DB_PREFIX . 'product_anchor_price` pap ON (pap.product_id = p.product_id)';
		}

		$sql = "SELECT p.product_id, p.sku, p.model, p.ean, p.upc, p.jan, p.isbn, p.mpn, p.quantity, " . $supplier_quantity_select . ", p.subtract, p.price, p.tax_class_id, p.date_available, p.date_modified, p.status, pd.name, m.name AS manufacturer, ss.name AS stock_status, " .
			$unit_select . ', ' . $unit_price_select . ', ' .
			"(SELECT pd2.price FROM `" . DB_PREFIX . "product_discount` pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . $customer_group_id . "' AND pd2.quantity = '1' AND (pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW()) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount_price, " .
			"(SELECT ps.price FROM `" . DB_PREFIX . "product_special` ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . $customer_group_id . "' AND (ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special_price, " .
			$anchor_select .
			" FROM `" . DB_PREFIX . "product` p" .
			" INNER JOIN `" . DB_PREFIX . "product_description` pd ON (pd.product_id = p.product_id AND pd.language_id = '" . $language_id . "')" .
			" INNER JOIN `" . DB_PREFIX . "product_to_store` p2s ON (p2s.product_id = p.product_id AND p2s.store_id = '" . $store_id . "')" .
			" LEFT JOIN `" . DB_PREFIX . "manufacturer` m ON (m.manufacturer_id = p.manufacturer_id)" .
			" LEFT JOIN `" . DB_PREFIX . "stock_status` ss ON (ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . $language_id . "')" .
			$anchor_join .
			" WHERE p.product_id > '" . (int)$last_product_id . "'";

		if (!$include_disabled) {
			$sql .= " AND p.status = '1' AND p.date_available <= NOW()";
		}

		$sql .= ' ORDER BY p.product_id ASC LIMIT ' . (int)$limit;

		return $this->db->query($sql)->rows;
	}

	private function normaliseProduct(array $product, $currency, $base_url) {
		$regular_price = $this->calculateDisplayPrice((float)$product['price'], (int)$product['tax_class_id']);
		$discount_price = $product['discount_price'] !== null
			? $this->calculateDisplayPrice((float)$product['discount_price'], (int)$product['tax_class_id'])
			: $regular_price;
		$current_price = $product['special_price'] !== null
			? $this->calculateDisplayPrice((float)$product['special_price'], (int)$product['tax_class_id'])
			: $discount_price;
		$is_special_sale = ($product['special_price'] !== null || $product['discount_price'] !== null);

		$anchor_price = '';

		if (isset($product['anchor_price']) && (float)$product['anchor_price'] > 0) {
			$anchor_price = $this->formatPrice(
				$this->calculateDisplayPrice((float)$product['anchor_price'], (int)$product['tax_class_id'])
			);
		}

		$quantity = (int)$product['quantity'];
		$supplier_quantity = (int)$product['suplierqty'];
		$available_quantity = $quantity + $supplier_quantity;
		$date_available = !empty($product['date_available']) ? strtotime($product['date_available']) : 0;
		$available = (
			(int)$product['status'] === 1 &&
			($date_available === false || $date_available <= time()) &&
			($available_quantity > 0 || (int)$product['subtract'] === 0)
		);
		$product_code = trim((string)$product['sku']) !== '' ? (string)$product['sku'] : (string)$product['model'];

		return array(
			'product_id' => (string)(int)$product['product_id'],
			'product_code' => $this->decodeText($product_code),
			'sku' => $this->decodeText($product['sku']),
			'model' => $this->decodeText($product['model']),
			'name' => $this->decodeText($product['name']),
			'brand' => $this->decodeText($product['manufacturer']),
			'unit_of_measure' => $this->decodeText($product['unit_of_measure']),
			'unit_price' => $this->decodeText($product['unit_price']),
			'barcode' => $this->decodeText($this->getBarcode($product)),
			'availability_code' => $available ? 'available' : 'unavailable',
			'availability' => $available ? 'dostupno' : 'nedostupno',
			'stock_status' => $this->decodeText($product['stock_status']),
			'quantity' => (string)$quantity,
			'supplier_quantity' => (string)$supplier_quantity,
			'available_quantity' => (string)$available_quantity,
			'regular_price' => $this->formatPrice($regular_price),
			'current_price' => $this->formatPrice($current_price),
			'retail_price' => $this->formatPrice($current_price),
			'special_sale' => $is_special_sale ? 'yes' : 'no',
			'special_sale_type' => $is_special_sale ? $this->decodeText($this->config->get('module_digital_pricelist_special_sale_name')) : '',
			'anchor_price' => $anchor_price,
			'anchor_reference_date' => !empty($product['anchor_reference_date']) && $product['anchor_reference_date'] !== '0000-00-00' ? (string)$product['anchor_reference_date'] : '',
			'currency' => (string)$currency,
			'url' => rtrim($base_url, '/') . '/index.php?route=product/product&product_id=' . (int)$product['product_id'],
			'date_modified' => (string)$product['date_modified']
		);
	}

	private function calculateDisplayPrice($price, $tax_class_id) {
		if ($this->tax && method_exists($this->tax, 'calculate')) {
			return (float)$this->tax->calculate($price, $tax_class_id, (bool)$this->config->get('config_tax'));
		}

		return (float)$price;
	}

	private function prepareTaxCalculator() {
		if (!class_exists('Cart\\Tax')) {
			return;
		}

		$original_customer_group_id = $this->config->get('config_customer_group_id');
		$this->config->set('config_customer_group_id', $this->getPublicCustomerGroupId());

		try {
			$tax = new \Cart\Tax($this->registry);
			$country_id = (int)$this->config->get('config_country_id');
			$zone_id = (int)$this->config->get('config_zone_id');

			if ($this->config->get('config_tax_default') === 'shipping') {
				$tax->setShippingAddress($country_id, $zone_id);
			}

			if ($this->config->get('config_tax_default') === 'payment') {
				$tax->setPaymentAddress($country_id, $zone_id);
			}

			$tax->setStoreAddress($country_id, $zone_id);
			$this->tax = $tax;
		} finally {
			$this->config->set('config_customer_group_id', $original_customer_group_id);
		}
	}

	private function formatPrice($price) {
		return number_format((float)$price, 4, '.', '');
	}

	private function getBarcode(array $product) {
		foreach (array('ean', 'upc', 'jan', 'isbn', 'mpn') as $field) {
			if (!empty($product[$field])) {
				return (string)$product[$field];
			}
		}

		return '';
	}

	private function writeXmlProduct($handle, array $record) {
		$xml = "    <product>\n";

		foreach ($record as $name => $value) {
			$xml .= '      <' . $name . '>' . $this->xml($value) . '</' . $name . ">\n";
		}

		$xml .= "    </product>\n";
		$this->write($handle, $xml);
	}

	private function writeCsvRow($handle, array $row) {
		$row = array_map(array($this, 'neutraliseCsvCell'), $row);

		if (fputcsv($handle, $row, ',', '"', '\\') === false) {
			throw new RuntimeException('CSV data could not be written.');
		}
	}

	private function neutraliseCsvCell($value) {
		$value = (string)$value;

		// Preserve real negative numbers (for example backorder stock), while
		// preventing spreadsheet programs from evaluating user-controlled cells.
		if ($value !== '' && preg_match('/^-?\d+(?:\.\d+)?$/D', $value)) {
			return $value;
		}

		if ($value !== '' && (preg_match('/^[\t\r\n]/', $value) || preg_match('/^[\x00-\x20]*[=+\-@]/', $value))) {
			return "'" . $value;
		}

		return $value;
	}

	private function write($handle, $data) {
		$length = strlen($data);
		$written = fwrite($handle, $data);

		if ($written === false || $written !== $length) {
			throw new RuntimeException('XML data could not be written.');
		}
	}

	private function xml($value) {
		$value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', (string)$value);

		return htmlspecialchars((string)$value, ENT_QUOTES | ENT_XML1 | ENT_SUBSTITUTE, 'UTF-8');
	}

	private function decodeText($value) {
		return html_entity_decode((string)$value, ENT_QUOTES, 'UTF-8');
	}

	private function getStoreUrl() {
		$url = (string)$this->config->get('config_ssl');

		if ($url === '') {
			$url = (string)$this->config->get('config_url');
		}

		return $url;
	}

	private function getPublicCustomerGroupId() {
		$customer_group_id = (int)$this->config->get('module_digital_pricelist_customer_group_id');

		if ($customer_group_id > 0) {
			return $customer_group_id;
		}

		$query = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE store_id = '0' AND `key` = 'config_customer_group_id' LIMIT 1");

		return $query->num_rows ? (int)$query->row['value'] : 1;
	}

	private function getFeedLanguageId() {
		$language_id = (int)$this->config->get('module_digital_pricelist_language_id');

		if ($language_id > 0) {
			return $language_id;
		}

		$query = $this->db->query("SELECT l.language_id FROM `" . DB_PREFIX . "language` l INNER JOIN `" . DB_PREFIX . "setting` s ON (s.`key` = 'config_language' AND s.store_id = '0' AND s.`value` = l.code) LIMIT 1");

		return $query->num_rows ? (int)$query->row['language_id'] : (int)$this->config->get('config_language_id');
	}

	private function getStorageDirectory() {
		return rtrim(DIR_STORAGE, '/\\') . '/digital_pricelist/';
	}

	private function getArchiveDirectory() {
		return $this->getStorageDirectory() . 'archive/';
	}

	private function ensureStorageDirectories() {
		foreach (array($this->getStorageDirectory(), $this->getArchiveDirectory()) as $directory) {
			if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
				throw new RuntimeException('Digital price list storage directory could not be created: ' . $directory);
			}
		}
	}

	private function acquirePublicationLock($mode) {
		$this->ensureStorageDirectories();
		$lock = fopen($this->getStorageDirectory() . '.publish.lock', 'c');

		if (!$lock) {
			throw new RuntimeException('Digital price list publication lock could not be opened.');
		}

		if (!flock($lock, $mode)) {
			fclose($lock);
			throw new RuntimeException('Digital price list publication lock could not be acquired.');
		}

		return $lock;
	}

	private function releasePublicationLock($lock) {
		if (is_resource($lock)) {
			flock($lock, LOCK_UN);
			fclose($lock);
		}
	}

	private function archiveCurrentFiles() {
		$xml_path = $this->getCurrentPath('xml');
		$csv_path = $this->getCurrentPath('csv');

		if (!is_file($xml_path) && !is_file($csv_path)) {
			return array();
		}

		$source_mtime = max(
			is_file($xml_path) ? (int)filemtime($xml_path) : 0,
			is_file($csv_path) ? (int)filemtime($csv_path) : 0
		);
		$metadata = $this->readCurrentMetadata();
		$archive_number = isset($metadata['archive_number']) ? (int)$metadata['archive_number'] : 0;
		$base_name = isset($metadata['base_filename']) ? (string)$metadata['base_filename'] : '';

		if ($archive_number < 1 || !$this->isValidArchiveFilename($base_name . '.xml')) {
			$archive_number = $this->getNextArchiveNumber();
			$base_name = $this->buildArchiveBaseName($archive_number, date('Ymd_His', $source_mtime ?: time()));
		}

		$xml_archive = $this->getArchiveDirectory() . $base_name . '.xml';
		$csv_archive = $this->getArchiveDirectory() . $base_name . '.csv';

		if ($this->archiveRecordExists($archive_number)) {
			return array_filter(array(
				'xml' => is_file($xml_archive) ? $xml_archive : false,
				'csv' => is_file($csv_archive) ? $csv_archive : false
			));
		}

		$archived = array();
		$created = array();

		try {
			foreach (array('xml' => $xml_path, 'csv' => $csv_path) as $format => $source) {
				if (!is_file($source)) {
					continue;
				}

				$destination = $format === 'xml' ? $xml_archive : $csv_archive;

				// Recover an orphan left by an interrupted/older generation. There is
				// no matching database record at this point, and the exclusive
				// publication lock prevents a public reader from racing this repair.
				if ((file_exists($destination) || is_link($destination)) && !@unlink($destination)) {
					throw new RuntimeException('Orphaned digital price list archive could not be replaced.');
				}

				// Track the path before copying as a failed filesystem copy may still
				// leave a truncated destination behind.
				$created[] = $destination;

				// Current and archive live on the same storage volume, so a hard link
				// normally archives even very large feeds in O(1). Fall back to the
				// streaming filesystem copy for hosts that do not support hard links.
				if (!@link($source, $destination) && !copy($source, $destination)) {
					throw new RuntimeException('Previous digital price list could not be archived.');
				}

				@touch($destination, (int)filemtime($source));
				$archived[$format] = $destination;
			}

			$this->recordArchive($archive_number, $base_name, $source_mtime);
		} catch (Throwable $exception) {
			$cleanup_failed = false;

			foreach (array_reverse($created) as $destination) {
				if ((file_exists($destination) || is_link($destination)) && !@unlink($destination)) {
					$cleanup_failed = true;
				}
			}

			if ($cleanup_failed) {
				throw new RuntimeException(
					'Digital price list archive failed and partial files could not be removed. Original error: ' . $exception->getMessage(),
					0,
					$exception
				);
			}

			throw $exception;
		}

		return $archived;
	}

	private function replaceFile($source, $destination) {
		if (!rename($source, $destination)) {
			throw new RuntimeException('Current digital price list could not be replaced: ' . basename($destination));
		}

		@chmod($destination, 0644);
	}

	private function replaceCurrentFiles($xml_source, $csv_source, $archive_number, $base_name, $generated_at) {
		$destinations = array(
			'xml' => $this->getCurrentPath('xml'),
			'csv' => $this->getCurrentPath('csv'),
			'metadata' => $this->getStorageDirectory() . 'current.json'
		);
		$token = str_replace('.', '', uniqid('', true));
		$backups = array();
		$published = array();

		try {
			foreach ($destinations as $key => $destination) {
				if (!is_file($destination)) {
					continue;
				}

				$backup = $destination . '.rollback-' . $token;

				if (!rename($destination, $backup)) {
					throw new RuntimeException('Current digital price list could not be prepared for replacement: ' . basename($destination));
				}

				$backups[$key] = $backup;
			}

			$this->replaceFile($xml_source, $destinations['xml']);
			$published['xml'] = true;
			$this->replaceFile($csv_source, $destinations['csv']);
			$published['csv'] = true;
			$this->writeCurrentMetadata($archive_number, $base_name, $generated_at);
			$published['metadata'] = true;
		} catch (Throwable $exception) {
			$rollback_errors = array();

			foreach ($published as $key => $unused) {
				if (is_file($destinations[$key]) && !@unlink($destinations[$key])) {
					$rollback_errors[] = 'remove ' . basename($destinations[$key]);
				}
			}

			foreach ($backups as $key => $backup) {
				if (is_file($backup) && !@rename($backup, $destinations[$key])) {
					$rollback_errors[] = 'restore ' . basename($destinations[$key]);
				}
			}

			if ($rollback_errors) {
				throw new RuntimeException(
					'Digital price list publication failed and rollback was incomplete (' . implode(', ', $rollback_errors) . '). Original error: ' . $exception->getMessage(),
					0,
					$exception
				);
			}

			throw $exception;
		}

		foreach ($backups as $backup) {
			if (is_file($backup)) {
				@unlink($backup);
			}
		}
	}

	private function cleanupArchives() {
		$retention_days = max(30, (int)$this->config->get('module_digital_pricelist_archive_days'));
		$cutoff = time() - ($retention_days * 86400);
		$files = glob($this->getArchiveDirectory() . '*.{xml,csv}', GLOB_BRACE);

		if (!$files) {
			return;
		}

		foreach ($files as $file) {
			if (is_file($file) && $this->isValidArchiveFilename(basename($file)) && (int)filemtime($file) < $cutoff) {
				@unlink($file);
			}
		}
	}

	private function buildArchiveBaseName($archive_number, $stamp) {
		// Keep the complete ASCII filename (including .xml/.csv) below the
		// common 255-byte filesystem and VARCHAR(255) boundary.
		$object_type = $this->slug($this->decodeText($this->config->get('module_digital_pricelist_object_type')), 'objekt', 40);
		$object_address = $this->slug($this->decodeText($this->config->get('module_digital_pricelist_object_address')), 'adresa', 80);
		$object_code = $this->slug($this->decodeText($this->config->get('module_digital_pricelist_object_code')), 'oznaka', 40);

		$base_name = 'cjenik_' . $object_type . '_' . $object_address . '_' . $object_code . '_pohrana-' . str_pad((int)$archive_number, 6, '0', STR_PAD_LEFT) . '_' . $stamp;

		if (strlen($base_name . '.xml') > 255) {
			throw new RuntimeException('Digital price list filename exceeds the 255-byte limit.');
		}

		return $base_name;
	}

	private function readCurrentMetadata() {
		$path = $this->getStorageDirectory() . 'current.json';

		if (!is_file($path) || !is_readable($path)) {
			return array();
		}

		$data = json_decode((string)file_get_contents($path), true);

		if (!is_array($data) || empty($data['base_filename']) || !$this->isValidArchiveFilename($data['base_filename'] . '.xml')) {
			return array();
		}

		return $data;
	}

	private function writeCurrentMetadata($archive_number, $base_name, $generated_at) {
		$data = json_encode(array(
			'archive_number' => (int)$archive_number,
			'base_filename' => (string)$base_name,
			'generated_at' => (string)$generated_at
		), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

		if ($data === false) {
			throw new RuntimeException('Current digital price list metadata could not be encoded.');
		}

		$temp = tempnam($this->getStorageDirectory(), 'meta_');

		if (!$temp || file_put_contents($temp, $data, LOCK_EX) === false || !rename($temp, $this->getStorageDirectory() . 'current.json')) {
			if ($temp && is_file($temp)) {
				@unlink($temp);
			}

			throw new RuntimeException('Current digital price list metadata could not be stored.');
		}

		@chmod($this->getStorageDirectory() . 'current.json', 0644);
	}

	private function clearCurrentMetadata() {
		$path = $this->getStorageDirectory() . 'current.json';

		if (is_file($path) && !@unlink($path)) {
			throw new RuntimeException('Previous digital price list metadata could not be cleared.');
		}
	}

	private function slug($value, $fallback, $max_length) {
		$value = trim((string)$value);

		if ($value !== '' && function_exists('iconv')) {
			$converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);

			if ($converted !== false) {
				$value = $converted;
			}
		}

		$value = strtolower($value);
		$value = preg_replace('/[^a-z0-9]+/', '-', $value);
		$value = trim((string)$value, '-');

		return $value !== '' ? substr($value, 0, (int)$max_length) : $fallback;
	}

	private function isValidArchiveFilename($filename) {
		return (bool)preg_match('/^cjenik_[a-z0-9-]+_[a-z0-9-]+_[a-z0-9-]+_pohrana-[0-9]{6,}_[0-9]{8}_[0-9]{6}\.(xml|csv)$/D', (string)$filename);
	}

	private function getNextArchiveNumber() {
		if ($this->tableExists(DB_PREFIX . 'digital_pricelist_archive')) {
			$query = $this->db->query("SELECT MAX(archive_number) AS archive_number FROM `" . DB_PREFIX . "digital_pricelist_archive`");

			return (int)$query->row['archive_number'] + 1;
		}

		$files = glob($this->getArchiveDirectory() . '*.xml');

		return ($files ? count($files) : 0) + 1;
	}

	private function recordArchive($archive_number, $base_name, $source_mtime) {
		if (!$this->tableExists(DB_PREFIX . 'digital_pricelist_archive')) {
			return;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "digital_pricelist_archive` SET archive_number = '" . (int)$archive_number . "', archived_at = NOW(), source_generated_at = '" . $this->db->escape(date('Y-m-d H:i:s', (int)$source_mtime)) . "', base_filename = '" . $this->db->escape((string)$base_name) . "'");
	}

	private function archiveRecordExists($archive_number) {
		if (!$this->tableExists(DB_PREFIX . 'digital_pricelist_archive')) {
			return false;
		}

		$query = $this->db->query("SELECT digital_pricelist_archive_id FROM `" . DB_PREFIX . "digital_pricelist_archive` WHERE archive_number = '" . (int)$archive_number . "' LIMIT 1");

		return (bool)$query->num_rows;
	}

	private function anchorTableExists() {
		if ($this->anchor_table_exists === null) {
			$this->anchor_table_exists = $this->tableExists(DB_PREFIX . 'product_anchor_price');
		}

		return $this->anchor_table_exists;
	}

	private function historyTableExists() {
		if ($this->history_table_exists === null) {
			$this->history_table_exists = $this->tableExists(DB_PREFIX . 'digital_pricelist_run');
		}

		return $this->history_table_exists;
	}

	private function supplierQuantityColumnExists() {
		if ($this->supplier_quantity_column_exists === null) {
			$this->supplier_quantity_column_exists = $this->columnExists(DB_PREFIX . 'product', 'suplierqty');
		}

		return $this->supplier_quantity_column_exists;
	}

	private function tableExists($table_name) {
		$query = $this->db->query('SHOW TABLES');

		foreach ($query->rows as $row) {
			$value = reset($row);

			if ((string)$value === (string)$table_name) {
				return true;
			}
		}

		return false;
	}

	private function columnExists($table_name, $column_name) {
		$query = $this->db->query('SHOW COLUMNS FROM `' . str_replace('`', '``', (string)$table_name) . '`');

		foreach ($query->rows as $row) {
			if (isset($row['Field']) && (string)$row['Field'] === (string)$column_name) {
				return true;
			}
		}

		return false;
	}

	private function recordRun($status, $product_count, $duration_ms, $message) {
		try {
			if (!$this->historyTableExists()) {
				return;
			}

			$this->db->query("INSERT INTO `" . DB_PREFIX . "digital_pricelist_run` SET generated_at = NOW(), product_count = '" . (int)$product_count . "', duration_ms = '" . (int)$duration_ms . "', status = '" . $this->db->escape((string)$status) . "', message = '" . $this->db->escape(substr((string)$message, 0, 1000)) . "'");
		} catch (Throwable $exception) {
			$log = $this->registry->get('log');

			if ($log) {
				$log->write('Digital price list history could not be recorded: ' . $exception->getMessage());
			}
		}
	}
}

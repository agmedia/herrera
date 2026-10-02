<?php
class ControllerExtensionModuleDigitalPricelist extends Controller {
	public function index() {
		return '';
	}

	/**
	 * Public landing page for human-readable access to current and archived feeds.
	 */
	public function page() {
		if (!$this->isEnabled()) {
			return new Action('error/not_found');
		}

		$data = $this->load->language('extension/module/digital_pricelist');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->setDescription($this->language->get('text_meta_description'));

		$data['breadcrumbs'] = array(
			array(
				'text' => $this->language->get('text_home'),
				'href' => $this->viewUrl($this->url->link('common/home'))
			),
			array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->viewUrl($this->url->link('extension/module/digital_pricelist/page', '', true))
			)
		);

		$data['xml_url'] = $this->viewUrl($this->url->link('extension/module/digital_pricelist/xml', '', true));
		$data['csv_url'] = $this->viewUrl($this->url->link('extension/module/digital_pricelist/csv', '', true));
		$data['archives_api_url'] = $this->viewUrl($this->url->link('extension/module/digital_pricelist/archives', '', true));
		$data['archives'] = array();

		$this->load->model('extension/module/digital_pricelist');
		$lock = false;

		try {
			$lock = $this->model_extension_module_digital_pricelist->acquireReadLock();
			$archives = $this->model_extension_module_digital_pricelist->getArchives();
			$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
			$lock = false;

			foreach ($archives as $archive) {
				$timestamp = strtotime($archive['archived_at']);
				$data['archives'][] = array(
					'filename' => $archive['filename'],
					'format' => strtoupper($archive['format']),
					'archived_at' => $timestamp ? date($this->language->get('datetime_format'), $timestamp) : $archive['archived_at'],
					'size' => $this->formatBytes((int)$archive['size']),
					'url' => $this->viewUrl($this->url->link(
						'extension/module/digital_pricelist/archive',
						'file=' . rawurlencode($archive['filename']),
						true
					))
				);
			}
		} catch (Throwable $exception) {
			if (is_resource($lock)) {
				$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
			}

			$this->log->write('Digital price list page archive listing failed: ' . $exception->getMessage());
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('extension/module/digital_pricelist_page', $data));
	}

	/**
	 * Footer link data consumed by digital_pricelist.ocmod.xml.
	 */
	public function footer() {
		if (!$this->isEnabled()) {
			return array();
		}

		$this->load->language('extension/module/digital_pricelist');

		return array(
			'title' => $this->language->get('text_footer_link'),
			'href' => $this->viewUrl($this->url->link('extension/module/digital_pricelist/page', '', true))
		);
	}

	public function xml() {
		$this->serveCurrent('xml');
	}

	public function csv() {
		$this->serveCurrent('csv');
	}

	/**
	 * Public, read-only archive index. No storage paths are disclosed.
	 */
	public function archives() {
		if (!$this->isEnabled()) {
			$this->outputJson(array('error' => 'Not found.'), 404);
			return;
		}

		$this->load->model('extension/module/digital_pricelist');
		$lock = false;

		try {
			$lock = $this->model_extension_module_digital_pricelist->acquireReadLock();
			$archives = $this->model_extension_module_digital_pricelist->getArchives();
			$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
			$lock = false;
		} catch (Throwable $exception) {
			if (is_resource($lock)) {
				$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
			}

			$this->log->write('Digital price list archive index failed: ' . $exception->getMessage());
			$this->outputJson(array('error' => 'Price list archive is temporarily unavailable.'), 503);
			return;
		}

		foreach ($archives as &$archive) {
			$url = $this->url->link(
				'extension/module/digital_pricelist/archive',
				'file=' . rawurlencode($archive['filename']),
				true
			);
			$archive['url'] = str_replace('&amp;', '&', $url);
		}
		unset($archive);

		$this->response->addHeader('Cache-Control: public, max-age=300');
		$this->outputJson(array(
			'retention_days' => max(30, (int)$this->config->get('module_digital_pricelist_archive_days')),
			'archives' => $archives
		));
	}

	/**
	 * Public archive download with strict filename allow-listing.
	 */
	public function archive() {
		if (!$this->isEnabled()) {
			$this->notFound();
			return;
		}

		$filename = isset($this->request->get['file']) ? (string)$this->request->get['file'] : '';
		$this->load->model('extension/module/digital_pricelist');
		$lock = false;
		$snapshot = false;

		try {
			$lock = $this->model_extension_module_digital_pricelist->acquireReadLock();
			$path = $this->model_extension_module_digital_pricelist->getArchivePath($filename);

			if (!$path) {
				$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
				$lock = false;
				$this->notFound();
				return;
			}

			$snapshot = $this->openSnapshot($path);

			if (!$snapshot) {
				throw new RuntimeException('Archive file could not be opened.');
			}

			$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
			$lock = false;
		} catch (Throwable $exception) {
			if (is_resource($lock)) {
				$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
			}

			if (is_array($snapshot) && isset($snapshot['handle']) && is_resource($snapshot['handle'])) {
				fclose($snapshot['handle']);
			}

			$this->log->write('Digital price list archive download failed: ' . $exception->getMessage());
			$this->outputJson(array('error' => 'Price list archive is temporarily unavailable.'), 503);
			return;
		}

		$this->serveFile($snapshot, strtolower(pathinfo($filename, PATHINFO_EXTENSION)), $filename);
	}

	/**
	 * Protected web cron endpoint; the bundled CLI launcher needs no URL token.
	 */
	public function cron() {
		if (!$this->isEnabled()) {
			$this->outputJson(array('error' => 'Digital price list is disabled.'), 503);
			return;
		}

		if (!$this->isAuthorisedCronRequest()) {
			$this->outputJson(array('error' => 'Forbidden.'), 403);
			return;
		}

		try {
			$this->load->model('extension/module/digital_pricelist');
			$result = $this->model_extension_module_digital_pricelist->generate();

			$this->outputJson(array(
				'success' => true,
				'generated_at' => $result['generated_at'],
				'product_count' => (int)$result['product_count'],
				'duration_ms' => (int)$result['duration_ms']
			));
		} catch (Throwable $exception) {
			$this->log->write('Digital price list cron failed: ' . $exception->getMessage());
			$this->outputJson(array('error' => 'Generation failed.'), 500);
		}
	}

	private function serveCurrent($format) {
		if (!$this->isEnabled()) {
			$this->notFound();
			return;
		}

		$this->load->model('extension/module/digital_pricelist');
		$lock = false;
		$snapshot = false;

		try {
			$lock = $this->model_extension_module_digital_pricelist->acquireReadLock();
			$path = $this->model_extension_module_digital_pricelist->getCurrentPath($format);
			$download_name = $this->model_extension_module_digital_pricelist->getCurrentFilename($format);
			$snapshot = $this->openSnapshot($path);

			if (!$snapshot) {
				throw new RuntimeException('Current price list file could not be opened.');
			}

			$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
			$lock = false;
		} catch (Throwable $exception) {
			if (is_resource($lock)) {
				$this->model_extension_module_digital_pricelist->releaseReadLock($lock);
			}

			if (is_array($snapshot) && isset($snapshot['handle']) && is_resource($snapshot['handle'])) {
				fclose($snapshot['handle']);
			}

			$this->log->write('Digital price list download failed: ' . $exception->getMessage());
			$this->response->addHeader('Retry-After: 300');
			$this->outputJson(array('error' => 'Price list is temporarily unavailable.'), 503);
			return;
		}

		$this->serveFile($snapshot, $format, $download_name);
	}

	private function openSnapshot($path) {
		$handle = @fopen($path, 'rb');

		if (!$handle) {
			return false;
		}

		$stat = fstat($handle);

		if (!$stat) {
			fclose($handle);
			return false;
		}

		return array(
			'handle' => $handle,
			'mtime' => isset($stat['mtime']) ? (int)$stat['mtime'] : time(),
			'size' => isset($stat['size']) ? (int)$stat['size'] : 0
		);
	}

	private function serveFile(array $snapshot, $format, $download_name) {
		$handle = $snapshot['handle'];
		$mtime = (int)$snapshot['mtime'];
		$size = (int)$snapshot['size'];
		$etag = '"' . dechex($mtime) . '-' . dechex($size) . '"';
		$if_none_match = isset($this->request->server['HTTP_IF_NONE_MATCH'])
			? html_entity_decode(trim((string)$this->request->server['HTTP_IF_NONE_MATCH']), ENT_QUOTES, 'UTF-8')
			: '';
		$if_modified_since = isset($this->request->server['HTTP_IF_MODIFIED_SINCE']) ? strtotime((string)$this->request->server['HTTP_IF_MODIFIED_SINCE']) : false;
		$not_modified = false;

		if ($if_none_match !== '') {
			$not_modified = $if_none_match === '*' || in_array($etag, array_map('trim', explode(',', $if_none_match)), true);
		} elseif ($if_modified_since !== false) {
			$not_modified = $if_modified_since >= $mtime;
		}

		header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
		header('ETag: ' . $etag);
		header('Cache-Control: public, max-age=300');
		header('X-Content-Type-Options: nosniff');

		if ($not_modified) {
			fclose($handle);
			http_response_code(304);
			exit;
		}

		$content_type = $format === 'xml' ? 'application/xml; charset=utf-8' : 'text/csv; charset=utf-8';
		$download_name = str_replace(array('"', "\r", "\n"), '', basename($download_name));
		header('Content-Type: ' . $content_type);
		header('Content-Disposition: inline; filename="' . $download_name . '"');
		header('Content-Length: ' . $size);

		if (isset($this->request->server['REQUEST_METHOD']) && strtoupper((string)$this->request->server['REQUEST_METHOD']) === 'HEAD') {
			fclose($handle);
			exit;
		}

		if (fpassthru($handle) === false) {
			$this->log->write('Digital price list could not be streamed: ' . $download_name);
		}

		fclose($handle);

		exit;
	}

	private function isEnabled() {
		return (bool)$this->config->get('module_digital_pricelist_status');
	}

	private function viewUrl($url) {
		return str_replace('&amp;', '&', $url);
	}

	private function formatBytes($bytes) {
		$bytes = max(0, (int)$bytes);
		$units = array('B', 'KB', 'MB', 'GB');
		$unit = 0;
		$value = (float)$bytes;

		while ($value >= 1024 && $unit < count($units) - 1) {
			$value /= 1024;
			$unit++;
		}

		return number_format($value, $unit === 0 ? 0 : 1, ',', '.') . ' ' . $units[$unit];
	}

	private function isAuthorisedCronRequest() {
		if (PHP_SAPI === 'cli' && defined('DIGITAL_PRICELIST_CLI') && DIGITAL_PRICELIST_CLI === true) {
			return true;
		}

		$configured_token = (string)$this->config->get('module_digital_pricelist_cron_token');
		$provided_token = '';

		if (isset($this->request->server['HTTP_X_DIGITAL_PRICELIST_TOKEN'])) {
			$provided_token = (string)$this->request->server['HTTP_X_DIGITAL_PRICELIST_TOKEN'];
		} elseif (isset($this->request->get['token'])) {
			$provided_token = (string)$this->request->get['token'];
		}

		return $configured_token !== '' && hash_equals($configured_token, $provided_token);
	}

	private function notFound() {
		http_response_code(404);
		$this->response->addHeader('HTTP/1.1 404 Not Found');
		$this->response->setOutput('Not found.');
	}

	private function outputJson(array $payload, $status_code = 200) {
		$status_text = array(
			200 => 'OK',
			403 => 'Forbidden',
			404 => 'Not Found',
			500 => 'Internal Server Error',
			503 => 'Service Unavailable'
		);

		if ($status_code !== 200) {
			http_response_code((int)$status_code);
			$this->response->addHeader('HTTP/1.1 ' . (int)$status_code . ' ' . $status_text[$status_code]);
		}

		$this->response->addHeader('Content-Type: application/json; charset=utf-8');
		$this->response->addHeader('X-Content-Type-Options: nosniff');
		$this->response->setOutput(json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
	}
}

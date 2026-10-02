<?php
/**
 * OpenCart digital price list CLI launcher.
 *
 * Example cron (daily at 07:30; scheduler timezone Europe/Zagreb):
 * CRON_TZ=Europe/Zagreb
 * 30 7 * * * /usr/bin/php /path/to/opencart/system/cli/digital_pricelist.php
 */
if (PHP_SAPI !== 'cli') {
	http_response_code(403);
	exit('CLI only.');
}

$opencart_root = dirname(__DIR__, 2);

if (!is_file($opencart_root . '/index.php') || !chdir($opencart_root)) {
	fwrite(STDERR, "OpenCart root could not be located.\n");
	exit(1);
}

define('DIGITAL_PRICELIST_CLI', true);

$_GET = array('route' => 'extension/module/digital_pricelist/cron');
$_POST = array();
$_REQUEST = $_GET;
$_COOKIE = array();

$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['HTTP_ACCEPT_LANGUAGE'] = '';
$_SERVER['REQUEST_URI'] = '/index.php?route=extension/module/digital_pricelist/cron';
$_SERVER['QUERY_STRING'] = 'route=extension/module/digital_pricelist/cron';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = $opencart_root . '/index.php';
$_SERVER['SERVER_PORT'] = 80;
$_SERVER['HTTPS'] = 'off';

require $opencart_root . '/index.php';

$status_code = http_response_code();

if ($status_code !== false && (int)$status_code >= 400) {
	exit(1);
}

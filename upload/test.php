<?php

use Agmedia\Api\Connection\Csv;

require_once('config.php');
require_once(DIR_STORAGE . 'vendor/autoload.php');

$path = DIR_UPLOAD . 'csv/ideus_products.csv';

$csv = new Csv($path);

\Agmedia\Helpers\Log::store($csv->getCsv(), 'csv');

echo '<pre>';
print_r($csv->getCsv());
echo '</pre>';


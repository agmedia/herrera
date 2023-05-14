<?php
// AGmedia Custom
define('OC_ENV', [
    'env'            => 'local',
    //
    'import' => [
        'default_category'        => 0,
        'default_action_category' => 0,
        'default_language'        => 3, // HR
        'default_tax_class'       => 1, // PDV
        'default_stock_empty'     => 5,
        'default_stock_full'      => 7,
        'default_attribute_group' => 1,
        'default_store_id'        => 0,
        'image_path'              => 'catalog/products/',
        'image_placeholder'       => 'catalog/products/no-image.jpg',
        //
        'ideus_csv_path' => 'csv/ideus_products.csv'
    ],
    //
    'attribute_sync' => [
        5  => 'Tip proizvoda', //'Product type',
        6  => 'Napon', //'Power supply',
        7  => 'Snaga', //'Power',
        8  => 'Colour',
        9  => 'Lampholder type',
        10 => 'Dedicated light source',
        11 => 'Replacing the light source',
        12 => 'Dimmer compatibility',
        13 => 'Colour temperature',
        14 => 'Light colour',
        15 => 'Luminous flux',
        16 => 'Luminous beam angle',
        17 => 'Ra',
        18 => 'Light source lifetime',
        19 => 'Power switch',
        20 => 'Adjusting the lighting direction',
        21 => 'IP',
        22 => 'Possibility of outdoor use',
        23 => 'Minimum distance from a lit object',
        24 => 'Electric shock protection class',
        25 => 'CE',
        26 => 'Material'
    ],
]);
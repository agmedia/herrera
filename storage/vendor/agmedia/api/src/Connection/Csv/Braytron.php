<?php

namespace Agmedia\Api\Connection\Csv;

use Agmedia\Api\Helper\Helper;
use Agmedia\Api\Models\OC_Attribute;
use Agmedia\Api\Models\OC_Product;
use Agmedia\Helpers\Log;
use Illuminate\Support\Carbon;

/**
 *
 */
class Braytron
{

    private $url = 'https://b2b.braytron.com/genel/xml/2159D3B6-3D43-4156-8E86-46083EB9A201';

    public $xml = null;

    public $quantity = [];


    public function getXML(bool $resolve_data = false)
    {
        $this->xml = simplexml_load_string(file_get_contents($this->url));

        if ($resolve_data) {
            $this->resolve();

            Log::store($this->quantity, 'xml_bry');

            return $this;
        }

        return $this->xml;
    }


    public function resolve()
    {
        $this->quantity = [];

        foreach ($this->xml->Stok as $item) {
            $this->quantity[] = [
                'sku' => (string) $item->ProductCode,
                'quantity' => (string) $item->Quantity
            ];
        }

        return $this;
    }
}
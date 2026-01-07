<?php

namespace Agmedia\Api\Connection\Csv;

use Agmedia\Helpers\Log;

/**
 *
 */
class Allegro
{

    /**
     * @var string
     */
    private $url = 'https://b2b.allegro-opt.com.ua/en/allegro-92675f0fd049059f6fd8a63d06646f43.xml';

    /**
     * @var null
     */
    public $xml = null;

    /**
     * @var array
     */
    public $quantity = [];




    /**
     * @param string|null $target
     *
     * @return $this|\$1|false|\SimpleXMLElement|null
     */
    public function getXML(string $target = null)
    {
        $this->xml = simplexml_load_string(file_get_contents($this->url));

        if ($target && $target == 'stock_quantity') {
            $this->resolveQuantity();

            return $this;
        }

       

        return $this->xml;
    }

 


    /**
     * @return $this
     */
    private function resolveQuantity()
    {
        $this->quantity = [];

        foreach ($this->xml->offer as $item) {
            $this->quantity[] = [
                'sku' => (string) $item->vendorCode,
                'quantity' => (string) $item->stock_quantity
            ];
        }

        return $this;
    }
}
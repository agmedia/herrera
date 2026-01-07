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
        $raw = @file_get_contents($this->url);
        if ($raw === false) {
            Log::write('Allegro XML download failed: ' . $this->url);
            $this->xml = null;
            return false;
        }

        $xml = @simplexml_load_string($raw);
        if ($xml === false) {
            Log::write('Allegro XML parse failed: ' . $this->url);
            $this->xml = null;
            return false;
        }

        $this->xml = $xml;

        if ($target === 'stock_quantity') {
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

        // Support both <offer> and <offers><offer>
        $offers = $this->xml->offer ?? ($this->xml->offers->offer ?? []);

        foreach ($offers as $item) {
            $sku = (string) $item->vendorCode;
            $qty = (string) $item->stock_quantity;

            if ($sku === '') {
                continue;
            }

            $this->quantity[] = [
                'sku'      => $sku,
                'quantity' => (int) $qty
            ];
        }

        return $this;
    }
}
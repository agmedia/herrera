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
class Eracuni
{

    /**
     * @var array|null
     */
    protected $data = null;


    /**
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        $this->data = $data;
    }


    /**
     * @return array
     */
    public function resolveProduct(array $data = null): array
    {
        $this->checkData($data);

        $brand       = OC_Product::resolveBrand();
        $categories  = OC_Product::resolveCategories();
        $attributes  = OC_Product::resolveGenericAttributes(isset($this->data['attributes']) ? $this->data['attributes'] : []);
        $description = Helper::resolveDescription($this->data['name'], $this->data['description']);
        //$images       = OC_Product::resolveImages($this->data);
        $stock_status = 1 ? agconf('import.default_stock_full') : agconf('import.default_stock_empty');
        $status       = 1;

        $description[agconf('import.default_language')]['tag'] = OC_Product::resolveTags($categories, $brand);

        //$image_path = $images[0]['image'] ?? agconf('import.image_placeholder');
        //unset($images[0]);

        return [
            'model'               => $this->data['productCode'],
            'sku'                 => $this->data['productCode'],
            'upc'                 => '',
            'ean'                 => Helper::setText($this->data['barCode']),
            'jan'                 => '',
            'isbn'                => '',
            'mpn'                 => '',
            'location'            => '',
            'price'               => (float) str_replace(',', '.', $this->data['grossPrice']),
            'tax_class_id'        => OC_Product::resolveTax(),
            'quantity'            => 1,
            'minimum'             => 1,
            'subtract'            => 1,
            'stock_status_id'     => $stock_status,
            'shipping'            => 1,
            'date_available'      => Carbon::now()->subDay()->format('Y-m-d'),
            'length'              => '',
            'width'               => '',
            'height'              => '',
            'length_class_id'     => 1,
            'weight'              => '',
            'weight_class_id'     => 1,
            'status'              => $status,
            'sort_order'          => 0,
            //'manufacturer'        => $brand['name'],
            'manufacturer_id'     => $brand['id'],
            'category'            => '',
            'filter'              => '',
            'download'            => '',
            'related'             => '',
            'image'               => agconf('import.image_placeholder'),
            'points'              => '',
            'product_store'       => [0 => 0],
            'product_attribute'   => $attributes,
            'product_description' => $description,
            'product_image'       => [],
            'product_layout'      => [0 => ''],
            'product_category'    => $categories,
            'product_seo_url'     => [0 => Helper::resolveSeoUrl($this->data['name'])],
        ];
    }


    public function createSale(string $type = 'order'): string
    {
        $data = 'apiTransactionId="' . $this->data['order_id'] . '"&sendIssuedInvoiceByEmail=true';

        if ($type == 'order') {
            $data .= '&SalesOrder=' . json_encode($this->getSale());
        }
        if ($type == 'offer') {
            $data .= '&SalesQuote=' . json_encode($this->getSale());
        }

        return $data;
    }


    private function getSale(): array
    {
        $response = [
            /*'city' => '',
            'printingTemplate' => '', // string
            'validUntil' => '', // date*/
            //'documentID' => $this->data['order_id'],
            'vatTransactionType' => '0', // string
            'buyerName' => $this->data['payment_firstname'] . ' ' . $this->data['payment_lastname'],
            'buyerStreet' => $this->data['payment_address_1'],
            'buyerPostalCode' => $this->data['payment_postcode'],
            'buyerCity' => $this->data['payment_city'],
            'buyerCountry' => 'HR',
            'buyerEMail' => $this->data['email'],
            'buyerPhone' => $this->data['telephone'],
            'validUntil' => Carbon::now()->addDays(7)->format('d.m.Y'),
            'methodOfPayment' => $this->getSaleMethodOfPayment(),
            'Address' => $this->getSaleAddress(),
            'Items' => $this->getSaleItems()
        ];

        return $response;
    }


    private function getSaleMethodOfPayment(): string
    {
        if ($this->data['payment_code'] == 'cod') {
            return 'Cash';
        }
        if ($this->data['payment_code'] == 'bank_transfer') {
            return 'BankTransfer';
        }

        return 'CreditCard';
    }


    private function getSaleItems(): array
    {
        $response = [];

        foreach ($this->data['products'] as $product) {
            $response[] = [
                'productCode' => $product['model'],
                'productName' => $product['name'],
                'quantity' => (int) $product['quantity'],
                'price' => (float) number_format($product['price'], 2, ',', ''),
            ];
        }

        return $response;
    }


    private function getSaleAddress(): array
    {
        return [
            'street' => $this->data['payment_address_1'],
            'postalCode' => $this->data['payment_postcode'],
            'city' => $this->data['payment_city'],
            'type' => 'Delivery'
        ];
    }


    /**
     * @param array|null $data
     *
     * @return array
     */
    public function resolveAttributes(array $data = null, string $param = null): array
    {
        $this->checkData($data);

        $res = [];
        $arr = preg_split('/\n|\r\n?/', $data[$param]);

        for ($i = 0; $i < count($arr); $i++) {
            if ($i) {
                $atr = explode(':', $arr[$i]);

                if (isset($atr[0]) && isset($atr[1])) {
                    $res[] = [
                        'title' => $atr[0],
                        'value' => $atr[1]
                    ];

                    OC_Attribute::makeAttribute($atr[0]);
                }
            }
        }

        return $res;
    }


    /**
     * @param array|null $data
     *
     * @return array
     */
    public function getQuantityUpdateQuary(array $data = null): array
    {
        if ($data) {
            $count = 1;
            $query = '';

            foreach ($data as $item) {
                $query .= '("' . $item['StockQuantityInfo']['productCode'] . '", ' . (int) $item['StockQuantityInfo']['quantityOnStock'] . ', 0),';

                $count++;
            }

            return [
                'query' => $query,
                'count' => $count
            ];
        }

        return [];
    }


    /**
     * @param array|null $data
     *
     * @return array
     */
    public function getPriceUpdateQuary(array $data = null): array
    {
        if ($data) {
            $count = 1;
            $query = '';

            foreach ($data as $item) {
                $query .= '("' . $item['productCode'] . '", 0, ' . (float) $item['grossPrice'] . '),';

                $count++;
            }

            return [
                'query' => $query,
                'count' => $count
            ];
        }

        return [];
    }


    /**
     * @param array|null $data
     *
     * @return void
     */
    private function checkData(array $data = null): void
    {
        if ($data) {
            $this->data = $data;
        }
    }
}
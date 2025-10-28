<?php

namespace Agmedia\Api\Connection\Csv;

use Agmedia\Api\Helper\Helper;
use Agmedia\Api\Models\OC_Attribute;
use Agmedia\Api\Models\OC_Product;
use Agmedia\Helpers\Log;
use Agmedia\Models\Order\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Klasa za pripremu podataka (proizvodi, narudžbe/ponude) za e-Računi API.
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
     * Normalizira podatke o proizvodu.
     *
     * @return array
     */
    public function resolveProduct(array $data = null): array
    {
        $this->checkData($data);

        $brand        = OC_Product::resolveBrand();
        $categories   = OC_Product::resolveCategories();
        $attributes   = OC_Product::resolveGenericAttributes(isset($this->data['attributes']) ? $this->data['attributes'] : []);
        $description  = Helper::resolveDescription($this->data['name'], $this->data['description']);
        $stock_status = 1 ? agconf('import.default_stock_full') : agconf('import.default_stock_empty');
        $status       = 1;

        $description[agconf('import.default_language')]['tag'] = OC_Product::resolveTags($categories, $brand);

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

    /**
     * Kreira payload za narudžbu/ponudu.
     *
     * @param string $type 'order' | 'offer'
     * @param string $mode 'json' (vrati ARRAY za JSON body) | 'form' (vrati form-urlencoded string)
     * @return array|string
     */
    public function createSale(string $type = 'order', string $mode = 'json')
    {
        $apiTransactionId = $this->data['order_id'] . '-' . Str::random(9);
        $rootKey = ($type === 'order') ? 'SalesOrder' : 'SalesQuote';

        // Izgradi sale kao čisti array (ispravni formati)
        $sale = $this->getSale();

        if ($mode === 'json') {
            // Vraća ARRAY spreman za JSON body (preporučeni način)
            return [
                'sendIssuedInvoiceByEmail' => true,
                'apiTransactionId'         => $apiTransactionId,
                $rootKey                   => $sale
            ];
        }

        if ($mode === 'form') {
            // Back-compat: form-urlencoded string (ne preporučujem)
            $data  = 'apiTransactionId="' . $apiTransactionId . '"&sendIssuedInvoiceByEmail=true';
            $data .= '&' . $rootKey . '=' . json_encode($sale, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            return $data;
        }

        // Fallback (tretiraj kao JSON)
        return [
            'sendIssuedInvoiceByEmail' => true,
            'apiTransactionId'         => $apiTransactionId,
            $rootKey                   => $sale
        ];
    }

    /**
     * Spremi broj dokumenta u narudžbu.
     *
     * @param string $type
     * @param array  $response
     * @param        $order_id
     * @return void
     */
    public function saveResponse(string $type, array $response, $order_id): void
    {
        if (isset($response['number'])) {
            if ($type == 'order') {
                $data = ['number_order' => $response['number']];
            } else {
                $data = ['number_quote' => $response['number']];
            }

            Order::query()->where('order_id', $order_id)->update($data);
        }
    }

    /**
     * Grade “sale” segment s ispravnim formatima (ISO datum, bez urlencode, numerička polja kao brojevi).
     *
     * @return array
     */
    private function getSale(): array
    {
        $company = json_decode($this->data['custom_field'], true);

        // Pokušaj odrediti zemlju iz VAT-a: SI… → SI, HR OIB (11 znamenki) → HR, default HR
        $buyerCountry = 'HR';
        $country      = 'HR';
        if (!empty($company[2]) && is_string($company[2])) {
            $vat = strtoupper($company[2]);
            if (strpos($vat, 'SI') === 0) {
                $buyerCountry = 'SI';
                $country      = 'SI';
            } elseif (preg_match('/^\d{11}$/', $vat)) {
                $buyerCountry = 'HR';
                $country      = 'HR';
            }
        }

        return [
            'vatTransactionType' => '0', // API očekuje string
            'buyerTaxNumber'     => $company[2] ?? '',
            'buyerName'          => $company[1] ?? '', // bez urlencode
            'buyerFirstName'     => $this->data['payment_firstname'] ?? '',
            'buyerLastName'      => $this->data['payment_lastname'] ?? '',
            'buyerStreet'        => $this->data['payment_address_1'] ?? '',
            'buyerPostalCode'    => $this->data['payment_postcode'] ?? '',
            'buyerCity'          => $this->data['payment_city'] ?? '',
            'buyerCountry'       => $buyerCountry,
            'buyerEMail'         => $this->data['email'] ?? '',
            'buyerPhone'         => $this->data['telephone'] ?? '',
            'validUntil'         => Carbon::now()->addDays(7)->format('Y-m-d'), // ISO 8601
            'methodOfPayment'    => $this->getSaleMethodOfPayment(),
            'country'            => $country,
            'Items'              => $this->getSaleItems(),
            'Address'            => $this->getSaleAddress($company, $country)
        ];
    }

    /**
     * Metoda plaćanja mapirana iz payment_code.
     *
     * @return string
     */
    private function getSaleMethodOfPayment(): string
    {
        if (($this->data['payment_code'] ?? null) == 'cod') {
            return 'Cash';
        }
        if (($this->data['payment_code'] ?? null) == 'bank_transfer') {
            return 'BankTransfer';
        }

        return 'CreditCard';
    }

    /**
     * Items — numerička polja kao brojevi (bez number_format).
     *
     * @return array
     */
    private function getSaleItems(): array
    {
        $response = [];

        foreach ($this->data['products'] as $product) {
            $price = isset($product['price']) ? (float) round((float) $product['price'], 2) : 0.0;

            $response[] = [
                'productCode' => $product['model'],
                'productName' => $product['name'],
                'quantity'    => (int) $product['quantity'],
                'netPrice'    => $price,
            ];
        }

        return $response;
    }

    /**
     * Adresa dostave — bez urlencode; country iz getSale().
     *
     * @return array
     */
    private function getSaleAddress(array $company, string $countryCode = 'HR'): array
    {
        return [
            'firstAddressLine' => $company[1] ?? '',
            'street'           => $this->data['shipping_address_1'] ?? '',
            'postalCode'       => $this->data['shipping_postcode'] ?? '',
            'city'             => $this->data['shipping_city'] ?? '',
            'country'          => $countryCode,
            'type'             => 'Delivery'
        ];
    }

    /**
     * Parsiranje custom atributa (bez promjena).
     *
     * @param array|null $data
     * @param string|null $param
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
     * Batch query pomoćne metode (bez promjena).
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

    public function getNameUpdateQuary(array $data = null): array
    {
        if ($data) {
            $count = 1;
            $query = '';

            foreach ($data as $item) {
                $replaced = str_replace('"', '', $item['name']);
                $query .= '("' . $item['productCode'] . '","' . $replaced . '"),';
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
     */
    private function checkData(array $data = null): void
    {
        if ($data) {
            $this->data = $data;
        }
    }
}

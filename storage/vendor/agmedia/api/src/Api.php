<?php

namespace Agmedia\Api;

use Agmedia\Helpers\Log;

/**
 * Class Luceed
 * @package Agmedia\Luceed
 */
class Api
{

    /**
     * @var string|mixed
     */
    private string $username = '';

    /**
     * @var string|mixed
     */
    private string $password = '';

    /**
     * @var string|mixed
     */
    private string $token = '';

    /**
     * @var string|mixed
     */
    private string $url = '';


    /**
     * @param string $username
     * @param string $pass
     * @param string $token
     * @param string $url
     */
    public function __construct()
    {
        $this->username = agconf('import.api.username');
        $this->password = agconf('import.api.password');
        $this->token    = agconf('import.api.token');
        $this->url      = agconf('import.api.url');
    }


    /**
     * @param string $url
     * @param array  $data
     *
     * @return bool|string
     */
    public function get(string $url, array $data)
    {
        try {
            $ch = curl_init($this->url . $url);
            curl_setopt($ch, CURLOPT_HEADER, ("Content-Type: application/json"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 500);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;

        } catch (\Exception $exception) {
            $this->log($url, $exception);

            return false;
        }
    }


    /**
     * @param string $url
     * @param array  $body
     *
     * @return mixed
     */
    public function post(string $url, array $body)
    {
        Log::store($this->url . $url, 'body');
        Log::store($body, 'body');

        try {
            $ch = curl_init($this->url . $url);
            curl_setopt($ch, CURLOPT_HEADER, ("Content-Type: application/json"));
            curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;

        } catch (\Exception $exception) {
            $this->log($url, $exception);

            return false;
        }
    }


    public function resolveImageData(string $sku)
    {
        return [
            "username"   => $this->username,
            "md5pass"    => $this->password,
            "token"      => $this->token,
            "method"     => "ProductImageGet",
            "parameters" => [
                "productCode" => $sku
            ]
        ];
    }


    /**
     * @param string     $type
     * @param string     $url
     * @param \Exception $exception
     */
    private function log(string $type, string $url, \Exception $exception): void
    {
        $log_name = 'luceed_' . $type . '_error';

        Log::store($url, $log_name);
        Log::store($exception->getMessage(), $log_name);
    }
}
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
    private $username;

    /**
     * @var string|mixed
     */
    private $password;

    /**
     * @var string|mixed
     */
    private $token;

    /**
     * @var string|mixed
     */
    private $url;


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
     * @param string     $url
     * @param array|null $data
     *
     * @return bool|string
     */
    public function get(string $url, array $data = null)
    {
        try {
            $ch = curl_init($this->url . $url);
            curl_setopt($ch, CURLOPT_HEADER, ("Content-Type: application/json"));
            curl_setopt($ch, CURLOPT_USERPWD, $this->resolveApiPassword());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 500);

            $response = curl_exec($ch);
            curl_close($ch);

            return $this->resolveResponse($response);

        } catch (\Exception $exception) {
            $this->log($url, $exception);

            return false;
        }
    }


    /**
     * @param string $url
     * @param string $body
     *
     * @return mixed
     */
    public function post(string $url, string $body)
    {
        try {
            $ch = curl_init($this->url . $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            curl_setopt($ch, CURLOPT_USERPWD, $this->resolveApiPassword());
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->resolveHeaders('form'));

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                $this->log($url, curl_error($ch));

                return false;
            }

            curl_close($ch);

            return $this->resolveResponse($response);

        } catch (\Exception $exception) {
            $this->log($url, $exception);

            return false;
        }
    }


    /**
     * @param string $sku
     *
     * @return string
     */
    public function resolveImageData(string $sku): string
    {
        return 'productCode=' . $sku;
    }

    /*******************************************************************************
     *                                Copyright : AGmedia                           *
     *                              email: filip@agmedia.hr                         *
     *******************************************************************************/

    private function resolveResponse($response)
    {
        $response = json_decode($response, true);

        if (isset($response['response']['result'])) {
            $response = $response['response']['result'];
        }

        return $response;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    private function resolveApiPassword(): string
    {
        return $this->username . ':' . $this->token . '_' . $this->password;
    }


    /**
     * @param string $type
     *
     * @return array
     */
    private function resolveHeaders(string $type): array
    {
        $headers = [];

        if ($type == 'form') {
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';

        } else {
            if ($type == 'xml') {
                $headers[] = 'Content-Type: application/xml';
            }
        }

        return $headers;
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
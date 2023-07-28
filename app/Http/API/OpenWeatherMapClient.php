<?php

namespace App\Http\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenWeatherMapClient
{
    /**
     * @var Client $client
     */
    protected $client;

    /**
     * @var string $apiKey
     */
    protected $apiKey;

    /**
     * @var string $url
     */
    protected  $url;

    /**
     * @var string units
     */
    protected $units;

    /**
     * @param Client $client
     * @param string $apiKey
     * @param string $url
     */
    public function __construct(Client $client, string $apiKey, string $url, string $units = 'metric')
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->url = $url;
        $this->units = $units;
    }

    /**
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    protected function post(array $params): array
    {
        $response = $this->client->post($this->url, ['query' => array_merge(
            ['appid' => $this->apiKey, 'units' => $this->units],
            $params
        )]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getWeatherByCoord(string $lat, string $long): array
    {
        return $this->post(['lat' => $lat, 'lon' => $long]);
    }

    /**
     * @param array $address
     * @return array
     * @throws GuzzleException
     */
    public function getWeatherByAddress(array $address): array
    {
        return $this->post(['q' => implode(',', $address)]);
    }
}

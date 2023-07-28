<?php

namespace App\Http\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NeutrinoApiClient
{
    /**
     * @var string $userId
     */
    protected $userId;

    /**
     * @var string $apiKey
     */
    protected $apiKey;

    /**
     * @var Client $client
     */
    protected $client;

    /**
     * @var string $url
     */
    protected $url;

    /**
     * @param Client $client
     * @param string $userId
     * @param string $apiKey
     * @param string $url
     */
    public function __construct(Client $client, string $userId, string $apiKey, string $url)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->userId = $userId;
        $this->url = $url;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param array $params
     * @return array
     */
    protected function post(array $params): array
    {
        $options = array_merge(
            ['headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'User-ID' => $this->userId,
                'API-Key' => $this->apiKey
            ]],
            ['form_params' => $params]
        );
        $response = $this->client->post( $this->url, $options);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $address
     * @return array
     */
    public function geoCodeAddress(string $address = '1 Molesworth Street, Pipitea, Wellington 6140, New Zealand'): array
    {
        return $this->post(['address' => $address]);
    }

    /**
     * @param string $lat
     * @param string $long
     * @return array
     */
    public function geoCodeCoordinates(string $lat, string $long): array
    {
        return $this->post([
            'latitude' => $lat,
            'longitude' => $long
        ]);
    }
}

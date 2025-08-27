<?php
namespace Infrastructure\ApiClients;

use GuzzleHttp\Client;

class ExternalApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.externa.com/',
            'timeout'  => 2.0,
        ]);
    }

    public function fetchData(string $endpoint): array
    {
        $response = $this->client->get($endpoint);
        return json_decode($response->getBody()->getContents(), true);
    }
}

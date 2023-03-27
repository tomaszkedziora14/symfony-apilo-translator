<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class ApiloApiService
{
    private $apiKey;
    private $httpClient;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = HttpClient::create();
    }

    public function getLanguages(): array
    {
        $response = $this->httpClient->request('GET', 'https://api.apilo.com/v1/languages', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey
            ]
        ]);

        return $response->toArray()['data'];
    }

    public function translate(string $source, string $target, string $text): string
    {
        $response = $this->httpClient->request('POST', 'https://api.apilo.com/v1/translate', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey
            ],
            'json' => [
                'source' => $source,
                'target' => $target,
                'text' => $text
            ]
        ]);

        return $response->toArray()['data']['translation'];
    }
}


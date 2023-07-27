<?php

declare(strict_types=1);

namespace App\Domain\Laureates;

use GuzzleHttp\Client;

class LaureatesService
{
    public function __construct(
        private Client $client,
        private LaureatesSorter $sorter,
    ) {}

    public function getLaureates(): array
    {
        try {
            $response = $this->client->get('https://api.nobelprize.org/2.1/laureates?offset=0&limit=50');
        } catch (\Exception $e) {
            // Handle Exception
        }

        if ($response->getStatusCode() !== 200) {
            // Handle exception
        }

        $json = json_decode($response->getBody()->getContents(), true);

        $laureates = [];
        foreach ($json['laureates'] as $laureate) {
            $laureates[] = Laureate::fromJson($laureate);
        }

        return $this->sorter->sort($laureates);
    }
}
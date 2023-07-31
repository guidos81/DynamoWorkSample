<?php

declare(strict_types=1);

namespace App\Domain\Laureates;

use GuzzleHttp\ClientInterface;

class LaureatesService
{
    private ClientInterface $client;
    private LaureatesSorter $sorter;

    public function __construct(
        ClientInterface $client,
        LaureatesSorter $sorter
    ) {
        $this->client = $client;
        $this->sorter = $sorter;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLaureates(): array
    {
        try {
            $response = $this->client->request('GET', 'https://api.nobelprize.org/2.1/laureates?offset=0&limit=50');
        } catch (\Exception $e) {
            throw $e;
        }

        if ($response->getStatusCode() !== 200) {
            // Handle failure responses
        }

        $json = json_decode($response->getBody()->getContents(), true);

        $laureates = [];
        foreach ($json['laureates'] as $laureate) {
            $laureates[] = Laureate::fromJson($laureate);
        }

        return $this->sorter->sort($laureates);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Application\Actions\Laureate;

use App\Application\Actions\ActionPayload;
use App\Domain\Laureates\Laureate;
use DI\Container;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Tests\TestCase;

class LaureatesActionTest extends TestCase
{

    public function testAction(): void
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $mock = new MockHandler([
            new Response(200, [], $this->getFixture('mock-laureates-response.json'))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $container->set(ClientInterface::class, $client);

        $request = $this->createRequest('GET', '/laureates');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = new ActionPayload(200, $this->getExpectedLaureatesResponse());
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    private function getExpectedLaureatesResponse(): array
    {
        return [
            new Laureate('George D. Snell', '1903-12-19', 'USA', 'Physiology or Medicine', '1980-10-10'),
            new Laureate('George E. Palade', '1912-11-19', 'Romania', 'Physiology or Medicine', '1974-10-10'),
            new Laureate('George Catlett Marshall', '1880-12-31', 'USA', 'Peace', '1953-10-30'),
            new Laureate('George de Hevesy', '1885-08-01', 'Austria-Hungary', 'Chemistry', '1944-11-09'),
        ];
    }

}
<?php

declare(strict_types=1);

namespace App\Application\Actions\Laureates;

use App\Application\Actions\Action;
use App\Domain\Laureates\LaureatesService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class LaureatesAction extends Action
{
    protected LaureatesService $service;

    public function __construct(LoggerInterface $logger, LaureatesService $service)
    {
        parent::__construct($logger);
        $this->service = $service;
    }

    public function action(): Response
    {
        $laureates = $this->service->getLaureates();

        $this->logger->info("Laureates list has been viewed.");

        return $this->respondWithData(array_slice($laureates, 0, 20));
    }
}

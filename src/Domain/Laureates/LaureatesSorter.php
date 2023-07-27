<?php

declare(strict_types=1);

namespace App\Domain\Laureates;

class LaureatesSorter
{
    public function sort(array $laureates): array
    {
        usort($laureates, function (Laureate $a, Laureate $b) {
            if ($a->getAwardedDate() === $b->getAwardedDate())
                return 0;

            return $a->getAwardedDate() < $b->getAwardedDate() ? 1 : -1;
        });

        return $laureates;
    }
}
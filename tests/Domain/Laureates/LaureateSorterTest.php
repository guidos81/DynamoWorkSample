<?php

declare(strict_types=1);

namespace Tests\Domain\Laureates;

use App\Domain\Laureates\Laureate;
use App\Domain\Laureates\LaureatesSorter;
use Tests\TestCase;

class LaureateSorterTest extends TestCase
{

    public function testSort(): void
    {
        $array = [
            new Laureate('name 4', 'birth', 'country', 'category', '2019-03-22'),
            new Laureate('name 3', 'birth', 'country', 'category', '2019-05-22'),
            new Laureate('name 1', 'birth', 'country', 'category', '2023-03-22'),
            new Laureate('name 6', 'birth', 'country', 'category', '1917-03-22'),
            new Laureate('name 2', 'birth', 'country', 'category', '2023-01-00'),
            new Laureate('name 5', 'birth', 'country', 'category', '1956-05-22'),
        ];

        $sorter = new LaureatesSorter();
        $array = $sorter->sort($array);

        $this->assertEquals('name 1', $array[0]->getFullName());
        $this->assertEquals('name 2', $array[1]->getFullName());
        $this->assertEquals('name 3', $array[2]->getFullName());
        $this->assertEquals('name 4', $array[3]->getFullName());
        $this->assertEquals('name 5', $array[4]->getFullName());
        $this->assertEquals('name 6', $array[5]->getFullName());
    }

    public function testSortNonLaureateArray(): void
    {
        $this->expectException(\TypeError::class);

        $array = [
            'random',
            'data',
            567
        ];

        $sorter = new LaureatesSorter();
        $array = $sorter->sort($array);
    }

}
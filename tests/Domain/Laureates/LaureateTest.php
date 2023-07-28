<?php

declare(strict_types=1);

namespace Tests\Domain\Laureates;

use App\Domain\Laureates\Laureate;
use Tests\TestCase;

class LaureateTest extends TestCase
{
    public function testGetters(): void
    {
        $laureate = new Laureate('Full Name', 'Birth Date', 'Native Country', 'Category', 'Awarded Date');

        $this->assertEquals('Full Name', $laureate->getFullName());
        $this->assertEquals('Birth Date', $laureate->getBirthDate());
        $this->assertEquals('Native Country', $laureate->getNativeCountry());
        $this->assertEquals('Category', $laureate->getCategory());
        $this->assertEquals('Awarded Date', $laureate->getAwardedDate());
    }

    public function testJsonSerialize(): void
    {
        $laureate = new Laureate('Full Name', 'Birth Date', 'Native Country', 'Category', 'Awarded Date');

        $this->assertJson(json_encode([
            'full-name' => 'Full Name',
            'birth-date' => 'Birth Date',
            'native-country' => 'Native Country',
            'category' => 'Category',
            'date-awarded' => 'Date Awarded',
        ]), json_encode($laureate));
    }

    public function testFromJson(): void
    {
        $json = json_decode($this->getFixture('single-laureate.json'), true);

        $laureate = Laureate::fromJson($json);

        $this->assertEquals('Aaron Klug', $laureate->getFullName());
        $this->assertEquals('1926-08-11', $laureate->getBirthDate());
        $this->assertEquals('Lithuania', $laureate->getNativeCountry());
        $this->assertEquals('Chemistry', $laureate->getCategory());
        $this->assertEquals('1982-10-18', $laureate->getAwardedDate());
    }
}

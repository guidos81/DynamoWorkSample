<?php

declare(strict_types=1);

namespace App\Domain\Laureates;

use JsonSerializable;

class Laureate implements JsonSerializable
{
    public function __construct(
        private string $fullName,
        private string $birthDate,
        private string $nativeCountry,
        private string $category,
        private string $awardedDate,
    ) {}

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getNativeCountry(): string
    {
        return $this->nativeCountry;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getAwardedDate(): string
    {
        return $this->awardedDate;
    }

    public function jsonSerialize(): array
    {
        return [
            'full-name' => $this->fullName,
            'birth-date' => $this->birthDate,
            'native-country' => $this->nativeCountry,
            'category' => $this->category,
            'date-awarded' => $this->awardedDate,
        ];
    }

    public static function fromJson(array $data): self
    {
        if (count($data['nobelPrizes']) > 1) {
            $prizeCategory = '';
            $prizeAwarded = '0';
            $comparisonDate = '0';
            foreach ($data['nobelPrizes'] as $prize) {
                $new = str_replace('-', '', $prize['dateAwarded']);
                if ($comparisonDate < $new) {
                    $prizeCategory = $prize['category']['en'];
                    $prizeAwarded = $prize['dateAwarded'];
                    $comparisonDate = $new;
                }
            }
        } else {
            $prizeCategory = $data['nobelPrizes'][0]['category']['en'];
            $prizeAwarded = $data['nobelPrizes'][0]['dateAwarded'];
        }

        return new self(
            $data['fullName']['en'],
            $data['birth']['date'],
            $data['birth']['place']['country']['en'],
            $prizeCategory,
            $prizeAwarded,
        );
    }
}
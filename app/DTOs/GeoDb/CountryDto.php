<?php
// app/DTOs/GeoDb/CountryDto.php

namespace App\DTOs\GeoDb;
readonly class CountryDto
{
    public function __construct(
        public string $code,
        public string $name,
        public string $currencyCode,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code:         $data['code'],
            name:         $data['name'],
            currencyCode: $data['currencyCodes'][0] ?? '',
        );
    }
}

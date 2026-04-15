<?php

namespace App\DTOs\AirportApi;

readonly class AirportDTO {
    public function __construct(
        public int $id,
        public string $wikiDataId,
        public string $type,
        public string $city,
        public string $name,
        public string $country,
        public string $countryCode,
        public string $region,
        public string $regionCode,
        public string $regionWdId,
        public float $latitude,
        public float $longitude,
        public int $population,
    ) {

    }

    public static function fromArray(array $data): self {
        return new self(
            id: $data['id'],
            wikiDataId: $data['wikiDataId'],
            type: $data['type'],
            city: $data['city'],
            name: $data['name'],
            country: $data['country'],
            countryCode: $data['countryCode'],
            region: $data['region'] ?? '',
            regionCode: $data['regionCode'],
            regionWdId: $data['regionWdId'],
            latitude: $data['latitude'],
            longitude: $data['longitude'],
            population: $data['population'],
        );
    }
}

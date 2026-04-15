<?php
// app/DTOs/GeoDb/CityDto.php
namespace App\DTOs\GeoDb;
readonly class CityDto
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $country,
        public string $countryCode,
        public string $region,
        public float  $latitude,
        public float  $longitude,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id:          $data['id'],
            name:        $data['name'],
            country:     $data['country'],
            countryCode: $data['countryCode'],
            region:      $data['region'] ?? '',
            latitude:    $data['latitude'],
            longitude:   $data['longitude'],
        );
    }
}

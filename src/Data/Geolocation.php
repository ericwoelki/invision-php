<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type GeolocationData array{lat: float|null, long: float|null, addressLines: list<string>, city: string, region: string, country: string, postalCode: string} */
final readonly class Geolocation
{
    /**
     * @param  list<string>  $addressLines
     */
    public function __construct(
        public ?float $latitude,
        public ?float $longitude,
        public array $addressLines,
        public string $city,
        public string $region,
        public string $country,
        public string $postalCode,
    ) {}

    /** @param GeolocationData $data */
    public static function fromArray(array $data): Geolocation
    {
        return new self(
            latitude: $data['lat'],
            longitude: $data['long'],
            addressLines: array_filter($data['addressLines']),
            city: $data['city'],
            region: $data['region'],
            country: $data['country'],
            postalCode: $data['postalCode'],
        );
    }
}

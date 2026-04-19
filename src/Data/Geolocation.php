<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type GeolocationData array{lat: float|null, long: float|null, addressLines: list<string|null>, city: string, region: string, country: string, postalCode: string} */
final readonly class Geolocation
{
    /**
     * @param  list<string>  $addressLines
     */
    public function __construct(
        public ?float $latitude = null,
        public ?float $longitude = null,
        public array $addressLines = [],
        public string $city = '',
        public string $region = '',
        public string $country = '',
        public string $postalCode = '',
    ) {}

    /** @param GeolocationData $data */
    public static function fromArray(array $data): Geolocation
    {
        return new self(
            latitude: $data['lat'],
            longitude: $data['long'],
            addressLines: array_values(array_filter(
                $data['addressLines'],
                static fn (?string $line): bool => $line !== null,
            )),
            city: $data['city'],
            region: $data['region'],
            country: $data['country'],
            postalCode: $data['postalCode'],
        );
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'lat' => $this->latitude,
            'long' => $this->longitude,
            'addressLines' => $this->addressLines,
            'city' => $this->city,
            'region' => $this->region,
            'country' => $this->country,
            'postalCode' => $this->postalCode,
        ];
    }
}

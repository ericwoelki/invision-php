<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/**
 * @phpstan-import-type GeolocationData from Geolocation
 *
 * @phpstan-type VenueData array{id: int, title: string, description: string, address: GeolocationData}
 */
final readonly class Venue
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public Geolocation $address,
    ) {}

    /** @param VenueData $data */
    public static function fromArray(array $data): Venue
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            description: $data['description'],
            address: Geolocation::fromArray($data['address']),
        );
    }
}

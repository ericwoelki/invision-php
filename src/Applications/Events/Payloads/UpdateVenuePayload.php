<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Data\Geolocation;
use EricWoelki\Invision\Payload;

final readonly class UpdateVenuePayload extends Payload
{
    public function __construct(
        public int $venueId,
        public ?string $title = null,
        public ?Geolocation $address = null,
        public ?string $description = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'title' => $this->title,
            'address' => $this->address?->toArray(),
            'description' => $this->description,
        ]);
    }
}

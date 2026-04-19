<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Data\Geolocation;
use EricWoelki\Invision\Payload;

final readonly class CreateVenuePayload extends Payload
{
    public function __construct(
        public string $title,
        public Geolocation $address,
        public ?string $description = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'title' => $this->title,
            'address' => $this->address->toArray(),
            'description' => $this->description,
        ]);
    }
}

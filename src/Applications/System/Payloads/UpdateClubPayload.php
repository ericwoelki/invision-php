<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Enums\ClubMemberVisibility;
use EricWoelki\Invision\Enums\ClubType;
use EricWoelki\Invision\Payload;

final readonly class UpdateClubPayload extends Payload
{
    public function __construct(
        public int $clubId,
        public ?string $name = null,
        public ?string $about = null,
        public ?ClubType $type = null,
        public ?bool $approved = null,
        public ?bool $featured = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?ClubMemberVisibility $memberVisibility = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'name' => $this->name,
            'about' => $this->about,
            'type' => $this->type?->value,
            'approved' => $this->approved,
            'featured' => $this->featured,
            'lat' => $this->latitude,
            'long' => $this->longitude,
            'showMemberTab' => $this->memberVisibility?->value,
        ]);
    }
}

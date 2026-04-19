<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Payload;

final readonly class ListCalendarsPayload extends Payload
{
    public function __construct(
        public ?bool $includeClubs = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'clubs' => $this->includeClubs !== null ? (int) $this->includeClubs : null,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

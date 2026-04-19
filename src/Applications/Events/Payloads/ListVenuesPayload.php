<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Payload;

final readonly class ListVenuesPayload extends Payload
{
    public function __construct(
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

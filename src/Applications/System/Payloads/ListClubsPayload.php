<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Payload;

final readonly class ListClubsPayload extends Payload
{
    public function __construct(
        public ?int $page = null,
        public ?int $perPage = null,
        public ?int $viewAsMemberId = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'page' => $this->page,
            'perPage' => $this->perPage,
            'member_id' => $this->viewAsMemberId,
        ]);
    }
}

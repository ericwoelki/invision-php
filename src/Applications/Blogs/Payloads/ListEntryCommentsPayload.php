<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Payloads;

use EricWoelki\Invision\Payload;

final readonly class ListEntryCommentsPayload extends Payload
{
    public function __construct(
        public int $entryId,
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

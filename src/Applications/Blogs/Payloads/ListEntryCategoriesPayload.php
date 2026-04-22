<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Payloads;

use EricWoelki\Invision\Enums\SortDirection;
use EricWoelki\Invision\Payload;

final readonly class ListEntryCategoriesPayload extends Payload
{
    public function __construct(
        public ?int $blogId = null,
        public ?string $sortBy = null,
        public ?SortDirection $sortDir = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'blog' => $this->blogId,
            'sortBy' => $this->sortBy,
            'sortDir' => $this->sortDir?->value,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

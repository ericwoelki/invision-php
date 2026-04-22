<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Payloads;

use EricWoelki\Invision\Enums\SortDirection;
use EricWoelki\Invision\Payload;

final readonly class ListBlogsPayload extends Payload
{
    /**
     * @param  list<int>|null  $blogIds
     * @param  list<int>|null  $ownerIds
     * @param  list<int>|null  $groupIds
     */
    public function __construct(
        public ?array $blogIds = null,
        public ?array $ownerIds = null,
        public ?array $groupIds = null,
        public ?bool $pinned = null,
        public ?string $sortBy = null,
        public ?SortDirection $sortDir = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'ids' => $this->blogIds !== null ? implode(',', $this->blogIds) : null,
            'owners' => $this->ownerIds !== null ? implode(',', $this->ownerIds) : null,
            'groups' => $this->groupIds !== null ? implode(',', $this->groupIds) : null,
            'pinned' => $this->pinned !== null ? (int) $this->pinned : null,
            'sortBy' => $this->sortBy,
            'sortDir' => $this->sortDir?->value,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

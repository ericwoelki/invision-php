<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Payloads;

use EricWoelki\Invision\Enums\SortDirection;
use EricWoelki\Invision\Payload;

final readonly class ListCommentsPayload extends Payload
{
    /**
     * @param  list<int>|null  $categoryIds
     * @param  list<int>|null  $authorIds
     */
    public function __construct(
        public int $databaseId,
        public ?array $categoryIds = null,
        public ?array $authorIds = null,
        public ?bool $locked = null,
        public ?bool $hidden = null,
        public ?bool $featured = null,
        public ?string $sortBy = null,
        public ?SortDirection $sortDir = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'categories' => $this->categoryIds !== null ? implode(',', $this->categoryIds) : null,
            'authors' => $this->authorIds !== null ? implode(',', $this->authorIds) : null,
            'locked' => $this->locked !== null ? (int) $this->locked : null,
            'hidden' => $this->hidden !== null ? (int) $this->hidden : null,
            'featured' => $this->featured !== null ? (int) $this->featured : null,
            'sortBy' => $this->sortBy,
            'sortDir' => $this->sortDir?->value,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

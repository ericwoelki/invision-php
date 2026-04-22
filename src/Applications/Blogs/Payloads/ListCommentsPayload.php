<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Payloads;

use EricWoelki\Invision\Enums\SortDirection;
use EricWoelki\Invision\Payload;

final readonly class ListCommentsPayload extends Payload
{
    /**
     * @param  list<int>|null  $blogIds
     * @param  list<int>|null  $authorIds
     */
    public function __construct(
        public ?array $blogIds = null,
        public ?array $authorIds = null,
        public ?bool $locked = null,
        public ?bool $hidden = null,
        public ?bool $pinned = null,
        public ?bool $featured = null,
        public ?bool $draft = null,
        public ?string $sortBy = null,
        public ?SortDirection $sortDir = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'blogs' => $this->blogIds !== null ? implode(',', $this->blogIds) : null,
            'authors' => $this->authorIds !== null ? implode(',', $this->authorIds) : null,
            'locked' => $this->locked !== null ? (int) $this->locked : null,
            'hidden' => $this->hidden !== null ? (int) $this->hidden : null,
            'pinned' => $this->pinned !== null ? (int) $this->pinned : null,
            'featured' => $this->featured !== null ? (int) $this->featured : null,
            'draft' => $this->draft !== null ? (int) $this->draft : null,
            'sortBy' => $this->sortBy,
            'sortDir' => $this->sortDir?->value,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

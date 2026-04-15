<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Enums\SortDirection;
use EricWoelki\Invision\Payload;

final readonly class ListTopicsPayload extends Payload
{
    /**
     * @param  list<int>|null  $forumIds
     * @param  list<int>|null  $topicIds
     * @param  list<int>|null  $authorIds
     */
    public function __construct(
        public ?array $forumIds = null,
        public ?array $topicIds = null,
        public ?array $authorIds = null,
        public ?bool $hasBestAnswer = null,
        public ?bool $hasPoll = null,
        public ?bool $locked = null,
        public ?bool $hidden = null,
        public ?bool $pinned = null,
        public ?bool $featured = null,
        public ?bool $archived = null,
        public ?string $sortBy = null,
        public ?SortDirection $sortDir = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'forums' => $this->forumIds !== null ? implode(',', $this->forumIds) : null,
            'ids' => $this->topicIds !== null ? implode(',', $this->topicIds) : null,
            'authors' => $this->authorIds !== null ? implode(',', $this->authorIds) : null,
            'hasBestAnswer' => $this->hasBestAnswer !== null ? (int) $this->hasBestAnswer : null,
            'hasPoll' => $this->hasPoll !== null ? (int) $this->hasPoll : null,
            'locked' => $this->locked !== null ? (int) $this->locked : null,
            'hidden' => $this->hidden !== null ? (int) $this->hidden : null,
            'pinned' => $this->pinned !== null ? (int) $this->pinned : null,
            'featured' => $this->featured !== null ? (int) $this->featured : null,
            'archived' => $this->archived !== null ? (int) $this->archived : null,
            'sortBy' => $this->sortBy,
            'sortDir' => $this->sortDir?->value,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

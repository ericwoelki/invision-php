<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use Carbon\CarbonImmutable;
use EricWoelki\Invision\Enums\SortDirection;
use EricWoelki\Invision\Payload;

final readonly class ListEventsPayload extends Payload
{
    /**
     * @param  list<int>|null  $eventIds
     * @param  list<int>|null  $calendarIds
     * @param  list<int>|null  $authorIds
     */
    public function __construct(
        public ?array $eventIds = null,
        public ?array $calendarIds = null,
        public ?array $authorIds = null,
        public ?bool $locked = null,
        public ?bool $hidden = null,
        public ?bool $featured = null,
        public ?CarbonImmutable $rangeStart = null,
        public ?CarbonImmutable $rangeEnd = null,
        public ?string $sortBy = null,
        public ?SortDirection $sortDir = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'ids' => $this->eventIds !== null ? implode(',', $this->eventIds) : null,
            'calendars' => $this->calendarIds !== null ? implode(',', $this->calendarIds) : null,
            'authors' => $this->authorIds !== null ? implode(',', $this->authorIds) : null,
            'locked' => $this->locked !== null ? (int) $this->locked : null,
            'hidden' => $this->hidden !== null ? (int) $this->hidden : null,
            'featured' => $this->featured !== null ? (int) $this->featured : null,
            'rangeStart' => $this->rangeStart?->format('Y-m-d'),
            'rangeEnd' => $this->rangeEnd?->format('Y-m-d'),
            'sortBy' => $this->sortBy,
            'sortDir' => $this->sortDir?->value,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

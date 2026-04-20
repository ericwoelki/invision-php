<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Data\Geolocation;
use EricWoelki\Invision\Enums\ContentVisibility;
use EricWoelki\Invision\Payload;

final readonly class CreateEventPayload extends Payload
{
    /**
     * @param  list<string>|null  $tags
     */
    public function __construct(
        public int $calendarId,
        public string $title,
        public string $description,
        public int $authorId,
        public string $start,
        public ?string $end = null,
        public ?string $recurrence = null,
        public ?bool $rsvp = null,
        public ?int $rsvpLimit = null,
        public ?Geolocation $location = null,
        public ?string $prefix = null,
        public ?array $tags = null,
        public ?string $date = null,
        public ?string $ipAddress = null,
        public ?bool $locked = null,
        public ?ContentVisibility $visibility = null,
        public ?bool $featured = null,
        public ?bool $anonymous = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'calendar' => $this->calendarId,
            'title' => $this->title,
            'description' => $this->description,
            'start' => $this->start,
            'author' => $this->authorId,
            'end' => $this->end,
            'recurrence' => $this->recurrence,
            'rsvp' => $this->rsvp,
            'rsvpLimit' => $this->rsvpLimit,
            'location' => $this->location?->toArray(),
            'prefix' => $this->prefix,
            'tags' => $this->tags !== null ? implode(',', $this->tags) : null,
            'date' => $this->date,
            'ip_address' => $this->ipAddress,
            'locked' => $this->locked !== null ? (int) $this->locked : null,
            'hidden' => $this->visibility?->value,
            'featured' => $this->featured !== null ? (int) $this->featured : null,
            'anonymous' => $this->anonymous !== null ? (int) $this->anonymous : null,
        ]);
    }
}

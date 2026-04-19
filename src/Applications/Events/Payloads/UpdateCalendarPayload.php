<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Payload;

final readonly class UpdateCalendarPayload extends Payload
{
    public function __construct(
        public int $calendarId,
        public ?string $title = null,
        public ?string $color = null,
        public ?bool $approveEvents = null,
        public ?bool $allowComments = null,
        public ?bool $approveComments = null,
        public ?bool $allowReviews = null,
        public ?bool $approveReviews = null,
        public ?CalendarPermissionsPayload $permissions = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'title' => $this->title,
            'color' => $this->color,
            'approve_events' => $this->approveEvents !== null ? (int) $this->approveEvents : null,
            'allow_comments' => $this->allowComments !== null ? (int) $this->allowComments : null,
            'approve_comments' => $this->approveComments !== null ? (int) $this->approveComments : null,
            'allow_reviews' => $this->allowReviews !== null ? (int) $this->allowReviews : null,
            'approve_reviews' => $this->approveReviews !== null ? (int) $this->approveReviews : null,
            'permissions' => $this->permissions?->toArray(),
        ]);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Enums\EventAttendance;
use EricWoelki\Invision\Payload;

final readonly class CreateEventRsvpPayload extends Payload
{
    public function __construct(
        public int $eventId,
        public int $memberId,
        public EventAttendance $attendance,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'response' => $this->attendance->value,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Payload;

final readonly class CalendarPermissionsPayload extends Payload
{
    /**
     * @param  list<int>|string  $view
     * @param  list<int>|string  $read
     * @param  list<int>|string  $add
     * @param  list<int>|string  $reply
     * @param  list<int>|string  $review
     * @param  list<int>|string  $askrsvp
     * @param  list<int>|string  $rsvp
     */
    public function __construct(
        public array|string $view,
        public array|string $read,
        public array|string $add,
        public array|string $reply,
        public array|string $review,
        public array|string $askrsvp,
        public array|string $rsvp,
    ) {}

    public function toArray(): array
    {
        return [
            'view' => $this->view,
            'read' => $this->read,
            'add' => $this->add,
            'reply' => $this->reply,
            'review' => $this->review,
            'askrsvp' => $this->askrsvp,
            'rsvp' => $this->rsvp,
        ];
    }
}

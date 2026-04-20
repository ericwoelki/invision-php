<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteEventRSVPRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly int $eventId,
        private readonly int $memberId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "calendar/events/{$this->eventId}/rsvps/{$this->memberId}";
    }
}

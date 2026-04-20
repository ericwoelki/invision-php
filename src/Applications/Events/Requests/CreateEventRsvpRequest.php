<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\CreateEventRsvpPayload;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasFormBody;

final class CreateEventRsvpRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::PUT;

    public function __construct(
        private readonly CreateEventRsvpPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "calendar/events/{$this->payload->eventId}/rsvps/{$this->payload->memberId}";
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

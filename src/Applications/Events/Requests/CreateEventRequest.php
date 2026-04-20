<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\CreateEventPayload;
use EricWoelki\Invision\Data\Event;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type EventData from Event */
final class CreateEventRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateEventPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/events';
    }

    public function createDtoFromResponse(Response $response): Event
    {
        /** @var EventData $data */
        $data = $response->json();

        return Event::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

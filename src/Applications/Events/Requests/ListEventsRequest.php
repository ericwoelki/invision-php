<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\ListEventsPayload;
use EricWoelki\Invision\Data\Event;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type EventData from Event */
final class ListEventsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListEventsPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/events';
    }

    /** @return array<int, Event> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, EventData> $data */
        $data = $response->json('results');

        return array_map(Event::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

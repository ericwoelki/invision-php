<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\ListCalendarsPayload;
use EricWoelki\Invision\Data\Calendar;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type CalendarData from Calendar */
final class ListCalendarsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListCalendarsPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/calendars';
    }

    /** @return array<int, Calendar> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, CalendarData> $data */
        $data = $response->json('results');

        return array_map(Calendar::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Data\Calendar;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type CalendarData from Calendar */
final class GetCalendarRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/calendars/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Calendar
    {
        /** @var CalendarData $data */
        $data = $response->json();

        return Calendar::fromArray($data);
    }
}

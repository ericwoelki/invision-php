<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\UpdateCalendarPayload;
use EricWoelki\Invision\Data\Calendar;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type CalendarData from Calendar */
final class UpdateCalendarRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly UpdateCalendarPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/calendars/'.$this->payload->calendarId;
    }

    public function createDtoFromResponse(Response $response): Calendar
    {
        /** @var CalendarData $data */
        $data = $response->json();

        return Calendar::fromArray($data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

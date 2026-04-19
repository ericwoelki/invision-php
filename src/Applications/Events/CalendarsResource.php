<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateCalendarPayload;
use EricWoelki\Invision\Applications\Events\Payloads\ListCalendarsPayload;
use EricWoelki\Invision\Applications\Events\Payloads\UpdateCalendarPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateCalendarRequest;
use EricWoelki\Invision\Applications\Events\Requests\GetCalendarRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListCalendarsRequest;
use EricWoelki\Invision\Applications\Events\Requests\UpdateCalendarRequest;
use EricWoelki\Invision\Data\Calendar;
use Saloon\Http\BaseResource;

final class CalendarsResource extends BaseResource
{
    /** @return array<int, Calendar> */
    public function list(?ListCalendarsPayload $payload = null): array
    {
        $request = new ListCalendarsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Calendar
    {
        $request = new GetCalendarRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateCalendarPayload $payload): Calendar
    {
        $request = new CreateCalendarRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function update(UpdateCalendarPayload $payload): Calendar
    {
        $request = new UpdateCalendarRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

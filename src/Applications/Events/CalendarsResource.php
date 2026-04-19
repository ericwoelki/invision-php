<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\ListCalendarsPayload;
use EricWoelki\Invision\Applications\Events\Requests\ListCalendarsRequest;
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
}

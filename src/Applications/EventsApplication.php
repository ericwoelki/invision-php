<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\Events\CalendarsResource;
use Saloon\Http\BaseResource;

final class EventsApplication extends BaseResource
{
    public function calendars(): CalendarsResource
    {
        return new CalendarsResource($this->connector);
    }
}

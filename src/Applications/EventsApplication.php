<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\Events\CalendarsResource;
use EricWoelki\Invision\Applications\Events\CommentsResource;
use EricWoelki\Invision\Applications\Events\EventsResource;
use EricWoelki\Invision\Applications\Events\VenuesResource;
use Saloon\Http\BaseResource;

final class EventsApplication extends BaseResource
{
    public function calendars(): CalendarsResource
    {
        return new CalendarsResource($this->connector);
    }

    public function events(): EventsResource
    {
        return new EventsResource($this->connector);
    }

    public function venues(): VenuesResource
    {
        return new VenuesResource($this->connector);
    }

    public function comments(): CommentsResource
    {
        return new CommentsResource($this->connector);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateEventPayload;
use EricWoelki\Invision\Applications\Events\Payloads\ListEventsPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateEventRequest;
use EricWoelki\Invision\Applications\Events\Requests\GetEventRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListEventsRequest;
use EricWoelki\Invision\Data\Event;
use Saloon\Http\BaseResource;

final class EventsResource extends BaseResource
{
    /** @return array<int, Event> */
    public function list(?ListEventsPayload $payload = null): array
    {
        $request = new ListEventsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Event
    {
        $request = new GetEventRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateEventPayload $payload): Event
    {
        $request = new CreateEventRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

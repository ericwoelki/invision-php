<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateEventRsvpPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateEventRsvpRequest;
use EricWoelki\Invision\Applications\Events\Requests\DeleteEventRsvpRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListEventRsvpsRequest;
use EricWoelki\Invision\Data\EventRsvps;
use Saloon\Http\BaseResource;

final class EventRsvpsResource extends BaseResource
{
    public function list(int $id): EventRsvps
    {
        $request = new ListEventRsvpsRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateEventRsvpPayload $payload): void
    {
        $this->connector->send(new CreateEventRsvpRequest($payload));
    }

    public function delete(int $eventId, int $memberId): void
    {
        $this->connector->send(new DeleteEventRsvpRequest($eventId, $memberId));
    }
}

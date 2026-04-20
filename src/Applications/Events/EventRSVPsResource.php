<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateEventRSVPPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateEventRSVPRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListEventRSVPsRequest;
use EricWoelki\Invision\Data\EventRSVPs;
use Saloon\Http\BaseResource;

final class EventRSVPsResource extends BaseResource
{
    public function list(int $id): EventRSVPs
    {
        $request = new ListEventRSVPsRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateEventRSVPPayload $payload): void
    {
        $this->connector->send(new CreateEventRSVPRequest($payload));
    }
}

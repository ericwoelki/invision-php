<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\ListVenuesPayload;
use EricWoelki\Invision\Applications\Events\Requests\GetVenueRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListVenuesRequest;
use EricWoelki\Invision\Data\Venue;
use Saloon\Http\BaseResource;

final class VenuesResource extends BaseResource
{
    /** @return array<int, Venue> */
    public function list(?ListVenuesPayload $payload = null): array
    {
        $request = new ListVenuesRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Venue
    {
        $request = new GetVenueRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

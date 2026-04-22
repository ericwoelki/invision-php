<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\ListClubsPayload;
use EricWoelki\Invision\Applications\System\Requests\GetClubRequest;
use EricWoelki\Invision\Applications\System\Requests\ListClubsRequest;
use EricWoelki\Invision\Data\Club;
use Saloon\Http\BaseResource;

final class ClubsResource extends BaseResource
{
    /** @return array<int, Club> */
    public function list(?ListClubsPayload $payload = null): array
    {
        $request = new ListClubsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Club
    {
        $request = new GetClubRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

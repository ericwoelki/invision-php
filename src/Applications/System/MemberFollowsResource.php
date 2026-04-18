<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\ListMemberFollowsPayload;
use EricWoelki\Invision\Applications\System\Requests\ListMemberFollowsRequest;
use EricWoelki\Invision\Data\Follow;
use Saloon\Http\BaseResource;

final class MemberFollowsResource extends BaseResource
{
    /** @return array<int, Follow> */
    public function list(ListMemberFollowsPayload $payload): array
    {
        $request = new ListMemberFollowsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberFollowPayload;
use EricWoelki\Invision\Applications\System\Payloads\ListMemberFollowsPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMemberFollowRequest;
use EricWoelki\Invision\Applications\System\Requests\DeleteMemberFollowRequest;
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

    public function create(CreateMemberFollowPayload $payload): Follow
    {
        $request = new CreateMemberFollowRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $memberId, string $followId): void
    {
        $this->connector->send(new DeleteMemberFollowRequest($memberId, $followId));
    }
}

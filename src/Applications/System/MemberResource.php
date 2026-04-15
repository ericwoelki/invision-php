<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\ListMembersPayload;
use EricWoelki\Invision\Applications\System\Requests\GetMemberRequest;
use EricWoelki\Invision\Applications\System\Requests\ListMembersRequest;
use EricWoelki\Invision\Data\Member;
use Saloon\Http\BaseResource;

final class MemberResource extends BaseResource
{
    /** @return array<int, Member> */
    public function list(?ListMembersPayload $payload): array
    {
        $request = new ListMembersRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Member
    {
        $request = new GetMemberRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

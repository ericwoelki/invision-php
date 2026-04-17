<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberPayload;
use EricWoelki\Invision\Applications\System\Payloads\ListMembersPayload;
use EricWoelki\Invision\Applications\System\Payloads\UpdateMemberPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMemberRequest;
use EricWoelki\Invision\Applications\System\Requests\GetMemberRequest;
use EricWoelki\Invision\Applications\System\Requests\ListMembersRequest;
use EricWoelki\Invision\Applications\System\Requests\UpdateMemberRequest;
use EricWoelki\Invision\Data\Member;
use Saloon\Http\BaseResource;

final class MembersResource extends BaseResource
{
    /** @return array<int, Member> */
    public function list(?ListMembersPayload $payload = null): array
    {
        $request = new ListMembersRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Member
    {
        $request = new GetMemberRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateMemberPayload $payload): Member
    {
        $request = new CreateMemberRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function update(UpdateMemberPayload $payload): Member
    {
        $request = new UpdateMemberRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

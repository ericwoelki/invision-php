<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\ListGroupsPayload;
use EricWoelki\Invision\Applications\System\Requests\DeleteGroupRequest;
use EricWoelki\Invision\Applications\System\Requests\GetGroupRequest;
use EricWoelki\Invision\Applications\System\Requests\ListGroupsRequest;
use EricWoelki\Invision\Data\Group;
use Saloon\Http\BaseResource;

final class GroupsResource extends BaseResource
{
    /** @return array<int, Group> */
    public function list(?ListGroupsPayload $payload = null): array
    {
        $request = new ListGroupsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Group
    {
        $request = new GetGroupRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $id): void
    {
        $this->connector->send(new DeleteGroupRequest($id));
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateClubMemberPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateClubMemberRequest;
use EricWoelki\Invision\Applications\System\Requests\DeleteClubMemberRequest;
use EricWoelki\Invision\Applications\System\Requests\ListClubMembersRequest;
use EricWoelki\Invision\Data\ClubMembership;
use Saloon\Http\BaseResource;

final class ClubMembersResource extends BaseResource
{
    public function list(int $id): ClubMembership
    {
        $request = new ListClubMembersRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateClubMemberPayload $payload): ClubMembership
    {
        $request = new CreateClubMemberRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $clubId, int $memberId): ClubMembership
    {
        $request = new DeleteClubMemberRequest($clubId, $memberId);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

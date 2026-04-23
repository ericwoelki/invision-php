<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

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
}

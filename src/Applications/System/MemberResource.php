<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Requests\GetMemberRequest;
use EricWoelki\Invision\Data\Member;
use Saloon\Http\BaseResource;

final class MemberResource extends BaseResource
{
    public function get(int $id): Member
    {
        $request = new GetMemberRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

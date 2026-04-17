<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\System\GroupsResource;
use EricWoelki\Invision\Applications\System\MembersResource;
use EricWoelki\Invision\Applications\System\MessagesResource;
use Saloon\Http\BaseResource;

final class SystemApplication extends BaseResource
{
    public function groups(): GroupsResource
    {
        return new GroupsResource($this->connector);
    }

    public function members(): MembersResource
    {
        return new MembersResource($this->connector);
    }

    public function messages(): MessagesResource
    {
        return new MessagesResource($this->connector);
    }
}

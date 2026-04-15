<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\System\GroupResource;
use EricWoelki\Invision\Applications\System\MemberResource;
use Saloon\Http\BaseResource;

final class SystemApplication extends BaseResource
{
    public function groups(): GroupResource
    {
        return new GroupResource($this->connector);
    }

    public function members(): MemberResource
    {
        return new MemberResource($this->connector);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\Forums\ForumResource;
use EricWoelki\Invision\Applications\Forums\PostResource;
use Saloon\Http\BaseResource;

final class ForumsApplication extends BaseResource
{
    public function forums(): ForumResource
    {
        return new ForumResource($this->connector);
    }

    public function posts(): PostResource
    {
        return new PostResource($this->connector);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\Forums\ForumsResource;
use EricWoelki\Invision\Applications\Forums\PostsResource;
use EricWoelki\Invision\Applications\Forums\TopicsResource;
use Saloon\Http\BaseResource;

final class ForumsApplication extends BaseResource
{
    public function forums(): ForumsResource
    {
        return new ForumsResource($this->connector);
    }

    public function topics(): TopicsResource
    {
        return new TopicsResource($this->connector);
    }

    public function posts(): PostsResource
    {
        return new PostsResource($this->connector);
    }
}

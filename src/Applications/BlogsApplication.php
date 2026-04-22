<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\Blogs\BlogsResource;
use EricWoelki\Invision\Applications\Blogs\CategoriesResource;
use EricWoelki\Invision\Applications\Blogs\EntryCategoriesResource;
use Saloon\Http\BaseResource;

final class BlogsApplication extends BaseResource
{
    public function categories(): CategoriesResource
    {
        return new CategoriesResource($this->connector);
    }

    public function entryCategories(): EntryCategoriesResource
    {
        return new EntryCategoriesResource($this->connector);
    }

    public function blogs(): BlogsResource
    {
        return new BlogsResource($this->connector);
    }
}

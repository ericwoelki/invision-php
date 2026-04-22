<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\Blogs\CategoriesResource;
use Saloon\Http\BaseResource;

final class BlogsApplication extends BaseResource
{
    public function categories(): CategoriesResource
    {
        return new CategoriesResource($this->connector);
    }
}

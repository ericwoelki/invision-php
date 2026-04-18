<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\Pages\CategoriesResource;
use EricWoelki\Invision\Applications\Pages\CommentsResource;
use EricWoelki\Invision\Applications\Pages\DatabasesResource;
use EricWoelki\Invision\Applications\Pages\RecordsResource;
use Saloon\Http\BaseResource;

final class PagesApplication extends BaseResource
{
    public function databases(): DatabasesResource
    {
        return new DatabasesResource($this->connector);
    }

    public function categories(): CategoriesResource
    {
        return new CategoriesResource($this->connector);
    }

    public function records(): RecordsResource
    {
        return new RecordsResource($this->connector);
    }

    public function comments(): CommentsResource
    {
        return new CommentsResource($this->connector);
    }
}

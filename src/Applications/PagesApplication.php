<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications;

use EricWoelki\Invision\Applications\Pages\DatabasesResource;
use Saloon\Http\BaseResource;

final class PagesApplication extends BaseResource
{
    public function databases(): DatabasesResource
    {
        return new DatabasesResource($this->connector);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Requests\ListDatabasesRequest;
use EricWoelki\Invision\Data\Database;
use Saloon\Http\BaseResource;

final class DatabasesResource extends BaseResource
{
    /** @return array<int, Database> */
    public function list(): array
    {
        $request = new ListDatabasesRequest;

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Requests\ListCategoriesRequest;
use EricWoelki\Invision\Data\DatabaseCategory;
use Saloon\Http\BaseResource;

final class CategoriesResource extends BaseResource
{
    /** @return array<int, DatabaseCategory> */
    public function list(int $databaseId): array
    {
        $request = new ListCategoriesRequest($databaseId);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

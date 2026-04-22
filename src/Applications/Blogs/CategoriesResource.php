<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListCategoriesPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\ListCategoriesRequest;
use EricWoelki\Invision\Data\BlogCategory;
use Saloon\Http\BaseResource;

final class CategoriesResource extends BaseResource
{
    /** @return array<int, BlogCategory> */
    public function list(?ListCategoriesPayload $payload = null): array
    {
        $request = new ListCategoriesRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

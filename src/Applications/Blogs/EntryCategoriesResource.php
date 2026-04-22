<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListEntryCategoriesPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\DeleteEntryCategoryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetEntryCategoryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListEntryCategoriesRequest;
use EricWoelki\Invision\Data\BlogCategory;
use Saloon\Http\BaseResource;

final class EntryCategoriesResource extends BaseResource
{
    /** @return array<int, BlogCategory> */
    public function list(?ListEntryCategoriesPayload $payload = null): array
    {
        $request = new ListEntryCategoriesRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): BlogCategory
    {
        $request = new GetEntryCategoryRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $id): void
    {
        $this->connector->send(new DeleteEntryCategoryRequest($id));
    }
}

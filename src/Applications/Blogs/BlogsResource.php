<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListBlogsPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\DeleteBlogRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetBlogRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListBlogsRequest;
use EricWoelki\Invision\Data\Blog;
use Saloon\Http\BaseResource;

final class BlogsResource extends BaseResource
{
    /** @return array<int, Blog> */
    public function list(?ListBlogsPayload $payload = null): array
    {
        $request = new ListBlogsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Blog
    {
        $request = new GetBlogRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $id): void
    {
        $this->connector->send(new DeleteBlogRequest($id));
    }
}

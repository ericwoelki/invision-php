<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\ListPostsPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\UpdatePostPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreatePostRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeletePostRequest;
use EricWoelki\Invision\Applications\Forums\Requests\GetPostRequest;
use EricWoelki\Invision\Applications\Forums\Requests\ListPostsRequest;
use EricWoelki\Invision\Applications\Forums\Requests\UpdatePostRequest;
use EricWoelki\Invision\Data\Post;
use Saloon\Http\BaseResource;

final class PostResource extends BaseResource
{
    /** @return array<int, Post> */
    public function list(?ListPostsPayload $payload = null): array
    {
        $request = new ListPostsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Post
    {
        $request = new GetPostRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreatePostPayload $payload): Post
    {
        $request = new CreatePostRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function update(UpdatePostPayload $payload): Post
    {
        $request = new UpdatePostRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $id): void
    {
        $this->connector->send(new DeletePostRequest($id));
    }
}

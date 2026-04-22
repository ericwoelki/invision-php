<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs;

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateCommentPayload;
use EricWoelki\Invision\Applications\Blogs\Payloads\ListCommentsPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateCommentRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetCommentRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class CommentsResource extends BaseResource
{
    /** @return array<int, Comment> */
    public function list(?ListCommentsPayload $payload = null): array
    {
        $request = new ListCommentsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Comment
    {
        $request = new GetCommentRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateCommentPayload $payload): Comment
    {
        $request = new CreateCommentRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

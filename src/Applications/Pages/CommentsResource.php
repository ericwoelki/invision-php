<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\CreateCommentPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\ListCommentsPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\UpdateCommentPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateCommentRequest;
use EricWoelki\Invision\Applications\Pages\Requests\DeleteCommentRequest;
use EricWoelki\Invision\Applications\Pages\Requests\GetCommentRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListCommentsRequest;
use EricWoelki\Invision\Applications\Pages\Requests\UpdateCommentRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class CommentsResource extends BaseResource
{
    public function reactions(): CommentReactionsResource
    {
        return new CommentReactionsResource($this->connector);
    }

    /** @return array<int, Comment> */
    public function list(ListCommentsPayload $payload): array
    {
        $request = new ListCommentsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $databaseId, int $commentId): Comment
    {
        $request = new GetCommentRequest($databaseId, $commentId);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateCommentPayload $payload): Comment
    {
        $request = new CreateCommentRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function update(UpdateCommentPayload $payload): Comment
    {
        $request = new UpdateCommentRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $databaseId, int $commentId): void
    {
        $this->connector->send(new DeleteCommentRequest($databaseId, $commentId));
    }
}

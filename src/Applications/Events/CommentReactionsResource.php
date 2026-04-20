<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateCommentReactionPayload;
use EricWoelki\Invision\Applications\Events\Payloads\DeleteCommentReactionPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateCommentReactionRequest;
use EricWoelki\Invision\Applications\Events\Requests\DeleteCommentReactionRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class CommentReactionsResource extends BaseResource
{
    public function create(CreateCommentReactionPayload $payload): Comment
    {
        $request = new CreateCommentReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(DeleteCommentReactionPayload $payload): Comment
    {
        $request = new DeleteCommentReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

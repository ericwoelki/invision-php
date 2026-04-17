<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostReactionPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\DeletePostReactionPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreatePostReactionRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeletePostReactionRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class PostReactionsResource extends BaseResource
{
    public function create(CreatePostReactionPayload $payload): Comment
    {
        $request = new CreatePostReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(DeletePostReactionPayload $payload): Comment
    {
        $request = new DeletePostReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

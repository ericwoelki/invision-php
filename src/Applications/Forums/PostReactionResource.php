<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostReactionPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\DeletePostReactionPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreatePostReactionRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeletePostReactionRequest;
use EricWoelki\Invision\Data\ReactedComment;
use Saloon\Http\BaseResource;

final class PostReactionResource extends BaseResource
{
    public function create(CreatePostReactionPayload $payload): ReactedComment
    {
        $request = new CreatePostReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(DeletePostReactionPayload $payload): ReactedComment
    {
        $request = new DeletePostReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

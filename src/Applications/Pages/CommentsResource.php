<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\ListCommentsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\ListCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class CommentsResource extends BaseResource
{
    /** @return array<int, Comment> */
    public function list(ListCommentsPayload $payload): array
    {
        $request = new ListCommentsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

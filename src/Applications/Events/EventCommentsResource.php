<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\ListEventCommentsPayload;
use EricWoelki\Invision\Applications\Events\Requests\ListEventCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class EventCommentsResource extends BaseResource
{
    /** @return array<int, Comment> */
    public function list(ListEventCommentsPayload $payload): array
    {
        $request = new ListEventCommentsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

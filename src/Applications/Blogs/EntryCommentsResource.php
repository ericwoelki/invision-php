<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListEntryCommentsPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\ListEntryCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class EntryCommentsResource extends BaseResource
{
    /** @return array<int, Comment> */
    public function list(ListEntryCommentsPayload $payload): array
    {
        $request = new ListEntryCommentsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

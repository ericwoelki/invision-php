<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordCommentsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\ListRecordCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class RecordCommentsResource extends BaseResource
{
    /** @return array<int, Comment> */
    public function list(ListRecordCommentsPayload $payload): array
    {
        $request = new ListRecordCommentsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

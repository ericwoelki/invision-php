<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateCommentReportPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateCommentReportRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\BaseResource;

final class CommentReportsResource extends BaseResource
{
    public function create(CreateCommentReportPayload $payload): Comment
    {
        $request = new CreateCommentReportRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

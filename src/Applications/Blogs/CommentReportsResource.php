<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs;

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateCommentReportPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateCommentReportRequest;
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

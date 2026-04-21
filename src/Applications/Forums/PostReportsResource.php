<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostReportPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreatePostReportRequest;
use EricWoelki\Invision\Data\Post;
use Saloon\Http\BaseResource;

final class PostReportsResource extends BaseResource
{
    public function create(CreatePostReportPayload $payload): Post
    {
        $request = new CreatePostReportRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

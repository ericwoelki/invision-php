<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\ListTopicPostsPayload;
use EricWoelki\Invision\Applications\Forums\Requests\ListTopicPostsRequest;
use EricWoelki\Invision\Data\Post;
use Saloon\Http\BaseResource;

final class TopicPostResource extends BaseResource
{
    /** @return array<int, Post> */
    public function list(ListTopicPostsPayload $payload): array
    {
        $request = new ListTopicPostsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

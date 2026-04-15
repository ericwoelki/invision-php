<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\ListTopicsPayload;
use EricWoelki\Invision\Applications\Forums\Requests\GetTopicRequest;
use EricWoelki\Invision\Applications\Forums\Requests\ListTopicsRequest;
use EricWoelki\Invision\Data\Topic;
use Saloon\Http\BaseResource;

final class TopicResource extends BaseResource
{
    /** @return array<int, Topic> */
    public function list(?ListTopicsPayload $payload = null): array
    {
        $request = new ListTopicsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Topic
    {
        $request = new GetTopicRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

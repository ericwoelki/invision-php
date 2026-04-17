<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\CreateTopicPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\ListTopicsPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\UpdateTopicPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreateTopicRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeleteTopicRequest;
use EricWoelki\Invision\Applications\Forums\Requests\GetTopicRequest;
use EricWoelki\Invision\Applications\Forums\Requests\ListTopicsRequest;
use EricWoelki\Invision\Applications\Forums\Requests\UpdateTopicRequest;
use EricWoelki\Invision\Data\Topic;
use Saloon\Http\BaseResource;

final class TopicsResource extends BaseResource
{
    public function posts(): TopicPostsResource
    {
        return new TopicPostsResource($this->connector);
    }

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

    public function create(CreateTopicPayload $payload): Topic
    {
        $request = new CreateTopicRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function update(UpdateTopicPayload $payload): Topic
    {
        $request = new UpdateTopicRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $id): void
    {
        $this->connector->send(new DeleteTopicRequest($id));
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\CreateForumPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\ListForumsPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreateForumRequest;
use EricWoelki\Invision\Applications\Forums\Requests\GetForumRequest;
use EricWoelki\Invision\Applications\Forums\Requests\ListForumsRequest;
use EricWoelki\Invision\Data\Forum;
use Saloon\Http\BaseResource;

final class ForumResource extends BaseResource
{
    /** @return array<int, Forum> */
    public function list(?ListForumsPayload $payload = null): array
    {
        $request = new ListForumsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Forum
    {
        $request = new GetForumRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateForumPayload $payload): Forum
    {
        $request = new CreateForumRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Payloads\CreateForumPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\DeleteForumPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\ListForumsPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\UpdateForumPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreateForumRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeleteForumRequest;
use EricWoelki\Invision\Applications\Forums\Requests\GetForumRequest;
use EricWoelki\Invision\Applications\Forums\Requests\ListForumsRequest;
use EricWoelki\Invision\Applications\Forums\Requests\UpdateForumRequest;
use EricWoelki\Invision\Data\Forum;
use Saloon\Http\BaseResource;

final class ForumsResource extends BaseResource
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

    public function update(UpdateForumPayload $payload): Forum
    {
        $request = new UpdateForumRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(DeleteForumPayload $payload): void
    {
        $this->connector->send(new DeleteForumRequest($payload));
    }
}

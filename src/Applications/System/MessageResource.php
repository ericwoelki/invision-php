<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateMessagePayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMessageRequest;
use EricWoelki\Invision\Applications\System\Requests\DeleteMessageRequest;
use Saloon\Http\BaseResource;

final class MessageResource extends BaseResource
{
    public function replies(): MessageReplyResource
    {
        return new MessageReplyResource($this->connector);
    }

    public function create(CreateMessagePayload $payload): void
    {
        $request = new CreateMessageRequest($payload);

        $this->connector->send($request);
    }

    public function delete(int $id): void
    {
        $this->connector->send(new DeleteMessageRequest($id));
    }
}

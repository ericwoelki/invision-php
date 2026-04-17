<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateMessagePayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMessageRequest;
use EricWoelki\Invision\Applications\System\Requests\DeleteMessageRequest;
use Saloon\Http\BaseResource;

final class MessagesResource extends BaseResource
{
    public function replies(): MessageRepliesResource
    {
        return new MessageRepliesResource($this->connector);
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

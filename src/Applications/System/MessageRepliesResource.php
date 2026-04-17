<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateMessageReplyPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMessageReplyRequest;
use Saloon\Http\BaseResource;

final class MessageRepliesResource extends BaseResource
{
    public function create(CreateMessageReplyPayload $payload): void
    {
        $this->connector->send(new CreateMessageReplyRequest($payload));
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateMessagePayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMessageRequest;
use Saloon\Http\BaseResource;

final class MessageResource extends BaseResource
{
    public function create(CreateMessagePayload $payload): void
    {
        $request = new CreateMessageRequest($payload);

        $this->connector->send($request);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Requests\Forums;

use EricWoelki\Invision\Payloads\Forums\ListForumsPayload;
use Saloon\Enums\Method;
use Saloon\Http\Request;

final class ListForumsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly ListForumsPayload $payload) {}

    public function resolveEndpoint(): string
    {
        return 'forums/forums';
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Requests\Topics;

use EricWoelki\Invision\Payloads\Topics\ListTopicsPayload;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Contracts\Paginatable;

final class ListTopicsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function __construct(private readonly ListTopicsPayload $payload) {}

    public function resolveEndpoint(): string
    {
        return 'forums/topics';
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

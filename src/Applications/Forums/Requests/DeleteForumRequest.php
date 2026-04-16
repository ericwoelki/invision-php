<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\DeleteForumPayload;
use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteForumRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly DeleteForumPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'forums/forums/'.$this->payload->forumId;
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteMessageRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/messages/'.$this->id;
    }
}

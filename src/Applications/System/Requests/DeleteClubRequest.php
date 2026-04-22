<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteClubRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/clubs/'.$this->id;
    }
}

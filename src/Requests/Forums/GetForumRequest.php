<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Requests\Forums;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class GetForumRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly int $id) {}

    public function resolveEndpoint(): string
    {
        return 'forums/forums/'.$this->id;
    }
}

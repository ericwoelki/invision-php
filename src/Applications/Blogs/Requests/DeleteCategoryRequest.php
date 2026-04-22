<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteCategoryRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/categories/'.$this->id;
    }
}

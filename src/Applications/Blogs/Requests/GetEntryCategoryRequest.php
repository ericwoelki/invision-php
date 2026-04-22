<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Data\BlogCategory;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type BlogCategoryData from BlogCategory */
final class GetEntryCategoryRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/entrycategories/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): BlogCategory
    {
        /** @var BlogCategoryData $data */
        $data = $response->json();

        return BlogCategory::fromArray($data);
    }
}

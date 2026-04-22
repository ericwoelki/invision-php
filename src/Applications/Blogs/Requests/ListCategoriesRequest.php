<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListCategoriesPayload;
use EricWoelki\Invision\Data\BlogCategory;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type BlogCategoryData from BlogCategory */
final class ListCategoriesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListCategoriesPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/categories';
    }

    /** @return array<int, BlogCategory> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, BlogCategoryData> $data */
        $data = $response->json('results');

        return array_map(BlogCategory::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

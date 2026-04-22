<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListBlogsPayload;
use EricWoelki\Invision\Data\Blog;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type BlogData from Blog */
final class ListBlogsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListBlogsPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/blogs';
    }

    /** @return array<int, Blog> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, BlogData> $data */
        $data = $response->json('results');

        return array_map(Blog::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

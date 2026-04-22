<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Data\Blog;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type BlogData from Blog */
final class GetBlogRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/blogs/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Blog
    {
        /** @var BlogData $data */
        $data = $response->json();

        return Blog::fromArray($data);
    }
}

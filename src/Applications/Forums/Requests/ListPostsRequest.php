<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\ListPostsPayload;
use EricWoelki\Invision\Data\Post;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type PostData from Post */
final class ListPostsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListPostsPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'forums/posts';
    }

    /** @return array<int, Post> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, PostData> $data */
        $data = $response->json('results');

        return array_map(Post::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

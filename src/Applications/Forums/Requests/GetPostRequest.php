<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Data\Post;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type PostData from Post */
final class GetPostRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly int $id) {}

    public function resolveEndpoint(): string
    {
        return 'forums/posts/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Post
    {
        /** @var PostData $data */
        $data = $response->json();

        return Post::fromArray($data);
    }
}

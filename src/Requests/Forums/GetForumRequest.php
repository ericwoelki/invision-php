<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Requests\Forums;

use EricWoelki\Invision\Data\Forum;
use EricWoelki\Invision\Enums\ForumType;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

final class GetForumRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly int $id) {}

    public function resolveEndpoint(): string
    {
        return 'forums/forums/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Forum
    {
        /** @var array{id: int, name: string, path: string, type: string, topics: int, url: string, parentId: int|null} $data */
        $data = $response->json();

        return new Forum(
            id: $data['id'],
            name: $data['name'],
            path: $data['path'],
            type: ForumType::from($data['type']),
            topics: $data['topics'],
            url: $data['url'],
            parentId: $data['parentId'] ?? null,
        );
    }
}

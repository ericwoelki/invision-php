<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Requests\Forums;

use EricWoelki\Invision\Data\Forum;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ForumData from Forum */
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
        /** @var ForumData $data */
        $data = $response->json();

        return Forum::fromArray($data);
    }
}

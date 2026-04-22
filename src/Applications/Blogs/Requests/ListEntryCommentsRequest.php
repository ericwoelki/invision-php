<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListEntryCommentsPayload;
use EricWoelki\Invision\Data\Comment;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type CommentData from Comment */
final class ListEntryCommentsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListEntryCommentsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "blog/entries/{$this->payload->entryId}/comments";
    }

    /** @return array<int, Comment> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, CommentData> $data */
        $data = $response->json('results');

        return array_map(Comment::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

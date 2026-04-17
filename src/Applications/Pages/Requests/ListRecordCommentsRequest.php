<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordCommentsPayload;
use EricWoelki\Invision\Data\Comment;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type CommentData from Comment */
final class ListRecordCommentsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListRecordCommentsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/records/{$this->payload->databaseId}/{$this->payload->recordId}/comments";
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

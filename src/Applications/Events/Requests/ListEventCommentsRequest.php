<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\ListEventCommentsPayload;
use EricWoelki\Invision\Data\Comment;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type CommentData from Comment */
final class ListEventCommentsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListEventCommentsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "calendar/events/{$this->payload->eventId}/comments";
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

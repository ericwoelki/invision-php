<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Applications\Blogs\Payloads\DeleteCommentReactionPayload;
use EricWoelki\Invision\Data\Comment;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type CommentData from Comment */
final class DeleteCommentReactionRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly DeleteCommentReactionPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "blog/comments/{$this->payload->commentId}/react";
    }

    public function createDtoFromResponse(Response $response): Comment
    {
        /** @var CommentData $data */
        $data = $response->json();

        return Comment::fromArray($data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Data\Comment;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type CommentData from Comment */
final class GetCommentRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $databaseId,
        private readonly int $commentId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/comments/{$this->databaseId}/{$this->commentId}";
    }

    public function createDtoFromResponse(Response $response): Comment
    {
        /** @var CommentData $data */
        $data = $response->json();

        return Comment::fromArray($data);
    }
}

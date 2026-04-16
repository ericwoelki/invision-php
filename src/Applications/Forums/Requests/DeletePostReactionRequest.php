<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\DeletePostReactionPayload;
use EricWoelki\Invision\Data\ReactedComment;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ReactedCommentData from ReactedComment */
final class DeletePostReactionRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly DeletePostReactionPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "forums/posts/{$this->payload->postId}/react";
    }

    public function createDtoFromResponse(Response $response): ReactedComment
    {
        /** @var ReactedCommentData $data */
        $data = $response->json();

        return ReactedComment::fromArray($data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

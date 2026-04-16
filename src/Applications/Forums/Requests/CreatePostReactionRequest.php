<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostReactionPayload;
use EricWoelki\Invision\Data\ReactedComment;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type ReactedCommentData from ReactedComment */
final class CreatePostReactionRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreatePostReactionPayload $payload,
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

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\CreateCommentPayload;
use EricWoelki\Invision\Data\Comment;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type CommentData from Comment */
final class CreateCommentRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateCommentPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/comments';
    }

    public function createDtoFromResponse(Response $response): Comment
    {
        /** @var CommentData $data */
        $data = $response->json();

        return Comment::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostReportPayload;
use EricWoelki\Invision\Data\Post;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type PostData from Post */
final class CreatePostReportRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreatePostReportPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "forums/posts/{$this->payload->postId}/report";
    }

    public function createDtoFromResponse(Response $response): Post
    {
        /** @var PostData $data */
        $data = $response->json();

        return Post::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\DeleteReviewReactionPayload;
use EricWoelki\Invision\Data\Review;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ReviewData from Review */
final class DeleteReviewReactionRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly DeleteReviewReactionPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "calendar/reviews/{$this->payload->reviewId}/react";
    }

    public function createDtoFromResponse(Response $response): Review
    {
        /** @var ReviewData $data */
        $data = $response->json();

        return Review::fromArray($data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

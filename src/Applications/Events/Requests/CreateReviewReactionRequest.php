<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\CreateReviewReactionPayload;
use EricWoelki\Invision\Data\Review;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type ReviewData from Review */
final class CreateReviewReactionRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateReviewReactionPayload $payload,
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

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

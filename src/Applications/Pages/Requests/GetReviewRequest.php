<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Data\Review;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ReviewData from Review */
final class GetReviewRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $databaseId,
        private readonly int $reviewId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/reviews/{$this->databaseId}/{$this->reviewId}";
    }

    public function createDtoFromResponse(Response $response): Review
    {
        /** @var ReviewData $data */
        $data = $response->json();

        return Review::fromArray($data);
    }
}

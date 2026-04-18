<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Applications\Pages\Payloads\ListReviewsPayload;
use EricWoelki\Invision\Data\Review;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ReviewData from Review */
final class ListReviewsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListReviewsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'cms/reviews/'.$this->payload->databaseId;
    }

    /** @return array<int, Review> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, ReviewData> $data */
        $data = $response->json('results');

        return array_map(Review::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

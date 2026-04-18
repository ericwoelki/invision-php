<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordReviewsPayload;
use EricWoelki\Invision\Data\Review;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ReviewData from Review */
final class ListRecordReviewsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListRecordReviewsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/records/{$this->payload->databaseId}/{$this->payload->recordId}/reviews";
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

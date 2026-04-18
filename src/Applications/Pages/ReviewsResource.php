<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\ListReviewsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\GetReviewRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListReviewsRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\BaseResource;

final class ReviewsResource extends BaseResource
{
    /** @return array<int, Review> */
    public function list(ListReviewsPayload $payload): array
    {
        $request = new ListReviewsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $databaseId, int $reviewId): Review
    {
        $request = new GetReviewRequest($databaseId, $reviewId);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

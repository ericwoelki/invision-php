<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\CreateReviewPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\ListReviewsPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\UpdateReviewPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateReviewRequest;
use EricWoelki\Invision\Applications\Pages\Requests\DeleteReviewRequest;
use EricWoelki\Invision\Applications\Pages\Requests\GetReviewRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListReviewsRequest;
use EricWoelki\Invision\Applications\Pages\Requests\UpdateReviewRequest;
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

    public function create(CreateReviewPayload $payload): Review
    {
        $request = new CreateReviewRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function update(UpdateReviewPayload $payload): Review
    {
        $request = new UpdateReviewRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $databaseId, int $reviewId): void
    {
        $this->connector->send(new DeleteReviewRequest($databaseId, $reviewId));
    }
}

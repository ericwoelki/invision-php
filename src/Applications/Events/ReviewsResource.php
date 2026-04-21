<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateReviewPayload;
use EricWoelki\Invision\Applications\Events\Payloads\ListReviewsPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateReviewRequest;
use EricWoelki\Invision\Applications\Events\Requests\GetReviewRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListReviewsRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\BaseResource;

final class ReviewsResource extends BaseResource
{
    /** @return array<int, Review> */
    public function list(?ListReviewsPayload $payload = null): array
    {
        $request = new ListReviewsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): Review
    {
        $request = new GetReviewRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateReviewPayload $payload): Review
    {
        $request = new CreateReviewRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

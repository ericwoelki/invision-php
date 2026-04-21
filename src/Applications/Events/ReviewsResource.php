<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateReviewPayload;
use EricWoelki\Invision\Applications\Events\Payloads\ListReviewsPayload;
use EricWoelki\Invision\Applications\Events\Payloads\UpdateReviewPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateReviewRequest;
use EricWoelki\Invision\Applications\Events\Requests\DeleteReviewRequest;
use EricWoelki\Invision\Applications\Events\Requests\GetReviewRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListReviewsRequest;
use EricWoelki\Invision\Applications\Events\Requests\UpdateReviewRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\BaseResource;

final class ReviewsResource extends BaseResource
{
    public function reactions(): ReviewReactionsResource
    {
        return new ReviewReactionsResource($this->connector);
    }

    public function reports(): ReviewReportsResource
    {
        return new ReviewReportsResource($this->connector);
    }

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

    public function update(UpdateReviewPayload $payload): Review
    {
        $request = new UpdateReviewRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $id): void
    {
        $this->connector->send(new DeleteReviewRequest($id));
    }
}

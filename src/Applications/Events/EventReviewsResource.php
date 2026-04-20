<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\ListEventReviewsPayload;
use EricWoelki\Invision\Applications\Events\Requests\ListEventReviewsRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\BaseResource;

final class EventReviewsResource extends BaseResource
{
    /** @return array<int, Review> */
    public function list(ListEventReviewsPayload $payload): array
    {
        $request = new ListEventReviewsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

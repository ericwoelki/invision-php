<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateReviewReactionPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateReviewReactionRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\BaseResource;

final class ReviewReactionsResource extends BaseResource
{
    public function create(CreateReviewReactionPayload $payload): Review
    {
        $request = new CreateReviewReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

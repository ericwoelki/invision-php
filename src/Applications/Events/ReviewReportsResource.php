<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events;

use EricWoelki\Invision\Applications\Events\Payloads\CreateReviewReportPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateReviewReportRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\BaseResource;

final class ReviewReportsResource extends BaseResource
{
    public function create(CreateReviewReportPayload $payload): Review
    {
        $request = new CreateReviewReportRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

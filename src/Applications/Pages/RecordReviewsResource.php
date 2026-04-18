<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordReviewsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\ListRecordReviewsRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\BaseResource;

final class RecordReviewsResource extends BaseResource
{
    /** @return array<int, Review> */
    public function list(ListRecordReviewsPayload $payload): array
    {
        $request = new ListRecordReviewsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

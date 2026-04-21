<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Data\Review;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ReviewData from Review */
final class GetReviewRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/reviews/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Review
    {
        /** @var ReviewData $data */
        $data = $response->json();

        return Review::fromArray($data);
    }
}

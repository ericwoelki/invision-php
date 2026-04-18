<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteReviewRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly int $databaseId,
        private readonly int $reviewId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/reviews/{$this->databaseId}/{$this->reviewId}";
    }
}

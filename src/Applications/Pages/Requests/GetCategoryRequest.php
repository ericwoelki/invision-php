<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Data\DatabaseCategory;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type DatabaseCategoryData from DatabaseCategory */
final class GetCategoryRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $databaseId,
        private readonly int $categoryId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/categories/{$this->databaseId}/{$this->categoryId}";
    }

    public function createDtoFromResponse(Response $response): DatabaseCategory
    {
        /** @var DatabaseCategoryData $data */
        $data = $response->json();

        return DatabaseCategory::fromArray($data);
    }
}

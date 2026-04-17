<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Data\DatabaseCategory;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type DatabaseCategoryData from DatabaseCategory */
final class ListCategoriesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $databaseId,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'cms/categories/'.$this->databaseId;
    }

    /** @return array<int, DatabaseCategory> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, DatabaseCategoryData> $data */
        $data = $response->json('results');

        return array_map(DatabaseCategory::fromArray(...), $data);
    }
}

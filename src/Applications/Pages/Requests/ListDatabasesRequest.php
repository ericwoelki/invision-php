<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Data\Database;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type DatabaseData from Database */
final class ListDatabasesRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'cms/databases';
    }

    /** @return array<int, Database> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, DatabaseData> $data */
        $data = $response->json('results');

        return array_map(Database::fromArray(...), $data);
    }
}

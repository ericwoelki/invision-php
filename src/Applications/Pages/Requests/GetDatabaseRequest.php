<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Data\Database;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type DatabaseData from Database */
final class GetDatabaseRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'cms/databases/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Database
    {
        /** @var DatabaseData $data */
        $data = $response->json();

        return Database::fromArray($data);
    }
}

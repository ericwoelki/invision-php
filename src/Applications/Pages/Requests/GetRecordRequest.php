<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Data\Record;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type RecordData from Record */
final class GetRecordRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $databaseId,
        private readonly int $recordId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/records/{$this->databaseId}/{$this->recordId}";
    }

    public function createDtoFromResponse(Response $response): Record
    {
        /** @var RecordData $data */
        $data = $response->json();

        return Record::fromArray($data);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordsPayload;
use EricWoelki\Invision\Data\Record;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type RecordData from Record */
final class ListRecordsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListRecordsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'cms/records/'.$this->payload->databaseId;
    }

    /** @return array<int, Record> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, RecordData> $data */
        $data = $response->json('results');

        return array_map(Record::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

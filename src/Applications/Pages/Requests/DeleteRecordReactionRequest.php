<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Applications\Pages\Payloads\DeleteRecordReactionPayload;
use EricWoelki\Invision\Data\Record;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type RecordData from Record */
final class DeleteRecordReactionRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly DeleteRecordReactionPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/records/{$this->payload->databaseId}/{$this->payload->recordId}/react";
    }

    public function createDtoFromResponse(Response $response): Record
    {
        /** @var RecordData $data */
        $data = $response->json();

        return Record::fromArray($data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

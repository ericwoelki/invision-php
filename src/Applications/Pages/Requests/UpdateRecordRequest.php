<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use EricWoelki\Invision\Applications\Pages\Payloads\UpdateRecordPayload;
use EricWoelki\Invision\Data\Record;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type RecordData from Record */
final class UpdateRecordRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly UpdateRecordPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/records/{$this->payload->databaseId}/{$this->payload->recordId}";
    }

    public function createDtoFromResponse(Response $response): Record
    {
        /** @var RecordData $data */
        $data = $response->json();

        return Record::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

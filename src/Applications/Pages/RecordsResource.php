<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\CreateRecordPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordsPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\UpdateRecordPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateRecordRequest;
use EricWoelki\Invision\Applications\Pages\Requests\DeleteRecordRequest;
use EricWoelki\Invision\Applications\Pages\Requests\GetRecordRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListRecordsRequest;
use EricWoelki\Invision\Applications\Pages\Requests\UpdateRecordRequest;
use EricWoelki\Invision\Data\Record;
use Saloon\Http\BaseResource;

final class RecordsResource extends BaseResource
{
    /** @return array<int, Record> */
    public function list(ListRecordsPayload $payload): array
    {
        $request = new ListRecordsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $databaseId, int $recordId): Record
    {
        $request = new GetRecordRequest($databaseId, $recordId);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateRecordPayload $payload): Record
    {
        $request = new CreateRecordRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function update(UpdateRecordPayload $payload): Record
    {
        $request = new UpdateRecordRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(int $databaseId, int $recordId): void
    {
        $this->connector->send(new DeleteRecordRequest($databaseId, $recordId));
    }
}

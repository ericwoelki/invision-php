<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\ListRecordsRequest;
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
}

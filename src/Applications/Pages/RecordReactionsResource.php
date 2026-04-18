<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages;

use EricWoelki\Invision\Applications\Pages\Payloads\CreateRecordReactionPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\DeleteRecordReactionPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateRecordReactionRequest;
use EricWoelki\Invision\Applications\Pages\Requests\DeleteRecordReactionRequest;
use EricWoelki\Invision\Data\Record;
use Saloon\Http\BaseResource;

final class RecordReactionsResource extends BaseResource
{
    public function create(CreateRecordReactionPayload $payload): Record
    {
        $request = new CreateRecordReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(DeleteRecordReactionPayload $payload): Record
    {
        $request = new DeleteRecordReactionRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateWarnReasonPayload;
use EricWoelki\Invision\Applications\System\Payloads\ListWarnReasonsPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateWarnReasonRequest;
use EricWoelki\Invision\Applications\System\Requests\GetWarnReasonRequest;
use EricWoelki\Invision\Applications\System\Requests\ListWarnReasonsRequest;
use EricWoelki\Invision\Data\WarnReason;
use Saloon\Http\BaseResource;

final class WarnReasonsResource extends BaseResource
{
    /** @return array<int, WarnReason> */
    public function list(?ListWarnReasonsPayload $payload = null): array
    {
        $request = new ListWarnReasonsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $id): WarnReason
    {
        $request = new GetWarnReasonRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateWarnReasonPayload $payload): WarnReason
    {
        $request = new CreateWarnReasonRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

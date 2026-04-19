<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberWarningPayload;
use EricWoelki\Invision\Applications\System\Payloads\DeleteMemberWarningPayload;
use EricWoelki\Invision\Applications\System\Payloads\ListMemberWarningsPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMemberWarningRequest;
use EricWoelki\Invision\Applications\System\Requests\DeleteMemberWarningRequest;
use EricWoelki\Invision\Applications\System\Requests\GetMemberWarningRequest;
use EricWoelki\Invision\Applications\System\Requests\ListMemberWarningsRequest;
use EricWoelki\Invision\Data\Warning;
use Saloon\Http\BaseResource;

final class MemberWarningsResource extends BaseResource
{
    /** @return array<int, Warning> */
    public function list(ListMemberWarningsPayload $payload): array
    {
        $request = new ListMemberWarningsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function get(int $memberId, int $warningId): Warning
    {
        $request = new GetMemberWarningRequest($memberId, $warningId);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateMemberWarningPayload $payload): Warning
    {
        $request = new CreateMemberWarningRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function delete(DeleteMemberWarningPayload $payload): void
    {
        $this->connector->send(new DeleteMemberWarningRequest($payload));
    }
}

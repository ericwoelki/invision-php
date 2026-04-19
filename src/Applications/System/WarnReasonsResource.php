<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\ListWarnReasonsPayload;
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
}

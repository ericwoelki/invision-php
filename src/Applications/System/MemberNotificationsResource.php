<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\ListMemberNotificationsPayload;
use EricWoelki\Invision\Applications\System\Requests\ListMemberNotificationsRequest;
use EricWoelki\Invision\Data\Notification;
use Saloon\Http\BaseResource;

final class MemberNotificationsResource extends BaseResource
{
    /** @return array<int, Notification> */
    public function list(ListMemberNotificationsPayload $payload): array
    {
        $request = new ListMemberNotificationsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

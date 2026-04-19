<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\ListMemberNotificationsPayload;
use EricWoelki\Invision\Data\Notification;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type NotificationData from Notification */
final class ListMemberNotificationsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListMemberNotificationsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/members/{$this->payload->memberId}/notifications";
    }

    /** @return array<int, Notification> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, NotificationData> $data */
        $data = $response->json('results');

        return array_map(Notification::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

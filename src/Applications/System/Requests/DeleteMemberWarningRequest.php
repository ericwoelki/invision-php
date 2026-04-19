<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\DeleteMemberWarningPayload;
use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteMemberWarningRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly DeleteMemberWarningPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/members/{$this->payload->memberId}/warnings/{$this->payload->warningId}";
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

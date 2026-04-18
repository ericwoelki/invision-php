<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteMemberFollowRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly int $memberId,
        private readonly string $followId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/members/{$this->memberId}/follows/{$this->followId}";
    }
}

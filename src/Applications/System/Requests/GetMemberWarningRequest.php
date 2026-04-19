<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Data\Warning;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type WarningData from Warning */
final class GetMemberWarningRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $memberId,
        private readonly int $warningId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/members/{$this->memberId}/warning/{$this->warningId}";
    }

    public function createDtoFromResponse(Response $response): Warning
    {
        /** @var WarningData $data */
        $data = $response->json();

        return Warning::fromArray($data);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberWarningPayload;
use EricWoelki\Invision\Data\Warning;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type WarningData from Warning */
final class CreateMemberWarningRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateMemberWarningPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/members/{$this->payload->memberId}/warnings";
    }

    public function createDtoFromResponse(Response $response): Warning
    {
        /** @var WarningData $data */
        $data = $response->json();

        return Warning::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

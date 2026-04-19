<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\CreateWarnReasonPayload;
use EricWoelki\Invision\Data\WarnReason;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type WarnReasonData from WarnReason */
final class CreateWarnReasonRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateWarnReasonPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/warnreasons';
    }

    public function createDtoFromResponse(Response $response): WarnReason
    {
        /** @var WarnReasonData $data */
        $data = $response->json();

        return WarnReason::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

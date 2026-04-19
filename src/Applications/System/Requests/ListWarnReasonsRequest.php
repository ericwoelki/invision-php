<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\ListWarnReasonsPayload;
use EricWoelki\Invision\Data\WarnReason;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type WarnReasonData from WarnReason */
final class ListWarnReasonsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListWarnReasonsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/warnreasons';
    }

    /** @return array<int, WarnReason> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, WarnReasonData> $data */
        $data = $response->json('results');

        return array_map(WarnReason::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Data\WarnReason;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type WarnReasonData from WarnReason */
final class GetWarnReasonRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/warnreasons/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): WarnReason
    {
        /** @var WarnReasonData $data */
        $data = $response->json();

        return WarnReason::fromArray($data);
    }
}

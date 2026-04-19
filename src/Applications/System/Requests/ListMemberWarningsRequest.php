<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\ListMemberWarningsPayload;
use EricWoelki\Invision\Data\Warning;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type WarningData from Warning */
final class ListMemberWarningsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListMemberWarningsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/members/{$this->payload->memberId}/warnings";
    }

    /** @return array<int, Warning> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, WarningData> $data */
        $data = $response->json('results');

        return array_map(Warning::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

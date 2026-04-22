<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\ListClubsPayload;
use EricWoelki\Invision\Data\Club;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ClubData from Club */
final class ListClubsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListClubsPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/clubs';
    }

    /** @return array<int, Club> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, ClubData> $data */
        $data = $response->json('results');

        return array_map(Club::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

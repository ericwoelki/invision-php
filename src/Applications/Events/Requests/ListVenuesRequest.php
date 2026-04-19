<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\ListVenuesPayload;
use EricWoelki\Invision\Data\Venue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type VenueData from Venue */
final class ListVenuesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListVenuesPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/venues';
    }

    /** @return array<int, Venue> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, VenueData> $data */
        $data = $response->json('results');

        return array_map(Venue::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

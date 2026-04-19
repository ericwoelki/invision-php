<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Data\Venue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type VenueData from Venue */
final class GetVenueRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/venues/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Venue
    {
        /** @var VenueData $data */
        $data = $response->json();

        return Venue::fromArray($data);
    }
}

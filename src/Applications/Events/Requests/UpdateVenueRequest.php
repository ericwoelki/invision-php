<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\UpdateVenuePayload;
use EricWoelki\Invision\Data\Venue;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type VenueData from Venue */
final class UpdateVenueRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly UpdateVenuePayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/venues/'.$this->payload->venueId;
    }

    public function createDtoFromResponse(Response $response): Venue
    {
        /** @var VenueData $data */
        $data = $response->json();

        return Venue::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

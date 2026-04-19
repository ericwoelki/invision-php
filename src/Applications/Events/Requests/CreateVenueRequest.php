<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Applications\Events\Payloads\CreateVenuePayload;
use EricWoelki\Invision\Data\Venue;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type VenueData from Venue */
final class CreateVenueRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateVenuePayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/venues';
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

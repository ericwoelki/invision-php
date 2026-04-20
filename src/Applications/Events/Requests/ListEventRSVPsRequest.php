<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Data\EventRSVPs;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type EventRSVPsData from EventRSVPs */
final class ListEventRSVPsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return "calendar/events/{$this->id}/rsvps";
    }

    public function createDtoFromResponse(Response $response): EventRSVPs
    {
        /** @var EventRSVPsData $data */
        $data = $response->json();

        return EventRSVPs::fromArray($data);
    }
}

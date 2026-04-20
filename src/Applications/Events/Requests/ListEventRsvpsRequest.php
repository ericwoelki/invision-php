<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Data\EventRsvps;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type EventRsvpsData from EventRsvps */
final class ListEventRsvpsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return "calendar/events/{$this->id}/rsvps";
    }

    public function createDtoFromResponse(Response $response): EventRsvps
    {
        /** @var EventRsvpsData $data */
        $data = $response->json();

        return EventRsvps::fromArray($data);
    }
}

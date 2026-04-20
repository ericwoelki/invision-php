<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use EricWoelki\Invision\Data\Event;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type EventData from Event */
final class GetEventRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/events/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Event
    {
        /** @var EventData $data */
        $data = $response->json();

        return Event::fromArray($data);
    }
}

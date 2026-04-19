<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteVenueRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'calendar/venues/'.$this->id;
    }
}

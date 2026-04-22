<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Data\Club;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ClubData from Club */
final class GetClubRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/clubs/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Club
    {
        /** @var ClubData $data */
        $data = $response->json();

        return Club::fromArray($data);
    }
}

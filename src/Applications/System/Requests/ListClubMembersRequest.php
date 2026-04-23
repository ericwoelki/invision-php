<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Data\ClubMembership;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ClubMembershipData from ClubMembership */
final class ListClubMembersRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/clubs/{$this->id}/members";
    }

    public function createDtoFromResponse(Response $response): ClubMembership
    {
        /** @var ClubMembershipData $data */
        $data = $response->json();

        return ClubMembership::fromArray($data);
    }
}

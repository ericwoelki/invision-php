<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\CreateClubMemberPayload;
use EricWoelki\Invision\Data\ClubMembership;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type ClubMembershipData from ClubMembership */
final class CreateClubMemberRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateClubMemberPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/clubs/{$this->payload->clubId}/members";
    }

    public function createDtoFromResponse(Response $response): ClubMembership
    {
        /** @var ClubMembershipData $data */
        $data = $response->json();

        return ClubMembership::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

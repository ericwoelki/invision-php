<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\ListMembersPayload;
use EricWoelki\Invision\Data\Member;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type MemberData from Member */
final class ListMembersRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListMembersPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/members';
    }

    /** @return array<int, Member> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, MemberData> $data */
        $data = $response->json('results');

        return array_map(Member::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\ListMemberFollowsPayload;
use EricWoelki\Invision\Data\Follow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type FollowData from Follow */
final class ListMemberFollowsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ListMemberFollowsPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/members/{$this->payload->memberId}/follows";
    }

    /** @return array<int, Follow> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, FollowData> $data */
        $data = $response->json('results');

        return array_map(Follow::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload->toArray();
    }
}

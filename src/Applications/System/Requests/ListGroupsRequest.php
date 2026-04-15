<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\ListGroupsPayload;
use EricWoelki\Invision\Data\Group;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type GroupData from Group */
final class ListGroupsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListGroupsPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/groups';
    }

    /** @return array<int, Group> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, GroupData> $data */
        $data = $response->json('results');

        return array_map(Group::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

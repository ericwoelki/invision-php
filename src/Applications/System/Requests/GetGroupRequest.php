<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Data\Group;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type GroupData from Group */
final class GetGroupRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/groups/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Group
    {
        /** @var GroupData $data */
        $data = $response->json();

        return Group::fromArray($data);
    }
}

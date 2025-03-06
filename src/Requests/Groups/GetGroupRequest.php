<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Requests\Groups;

use EricWoelki\Invision\Data\Group;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

final class GetGroupRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly int $id) {}

    public function resolveEndpoint(): string
    {
        return 'core/groups/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Group
    {
        /** @var array{id: int, name: string, formattedName: string} $data */
        $data = $response->json();

        return new Group(
            id: $data['id'],
            name: $data['name'],
            formattedName: $data['formattedName'],
        );
    }
}

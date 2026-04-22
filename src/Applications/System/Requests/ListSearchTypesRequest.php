<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

final class ListSearchTypesRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'core/search/contenttypes';
    }

    /** @return list<string> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array{contenttypes: list<string>} $data */
        $data = $response->json();

        return $data['contenttypes'];
    }
}

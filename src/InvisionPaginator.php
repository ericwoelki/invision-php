<?php

declare(strict_types=1);

namespace EricWoelki\Invision;

use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\PagedPaginator;

final class InvisionPaginator extends PagedPaginator
{
    protected function isLastPage(Response $response): bool
    {
        return $response->json('page') === $response->json('totalPages');
    }

    protected function getPageItems(Response $response, Request $request): array
    {
        /** @var array<array-key, mixed> */
        return $response->json('results');
    }
}

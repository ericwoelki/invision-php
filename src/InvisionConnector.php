<?php

declare(strict_types=1);

namespace EricWoelki\Invision;

use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Contracts\HasPagination;

final class InvisionConnector extends Connector implements HasPagination
{
    public function __construct(
        private readonly string $url,
        private readonly string $token,
    ) {}

    public function resolveBaseUrl(): string
    {
        return $this->url;
    }

    public function paginate(Request $request): InvisionPaginator
    {
        return new InvisionPaginator($this, $request);
    }

    protected function defaultAuth(): BasicAuthenticator
    {
        return new BasicAuthenticator($this->token, '');
    }
}

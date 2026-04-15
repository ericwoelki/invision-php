<?php

declare(strict_types=1);

namespace EricWoelki\Invision;

use EricWoelki\Invision\Applications\ForumsApplication;
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

    public function forums(): ForumsApplication
    {
        return new ForumsApplication($this);
    }

    protected function defaultAuth(): BasicAuthenticator
    {
        return new BasicAuthenticator($this->token, '');
    }
}

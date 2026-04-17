<?php

declare(strict_types=1);

namespace EricWoelki\Invision;

use EricWoelki\Invision\Applications\ForumsApplication;
use EricWoelki\Invision\Applications\PagesApplication;
use EricWoelki\Invision\Applications\SystemApplication;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

final class InvisionConnector extends Connector implements HasPagination
{
    use AlwaysThrowOnErrors;

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

    public function system(): SystemApplication
    {
        return new SystemApplication($this);
    }

    public function forums(): ForumsApplication
    {
        return new ForumsApplication($this);
    }

    public function pages(): PagesApplication
    {
        return new PagesApplication($this);
    }

    protected function defaultAuth(): BasicAuthenticator
    {
        return new BasicAuthenticator($this->token, '');
    }
}

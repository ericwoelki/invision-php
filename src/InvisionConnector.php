<?php

declare(strict_types=1);

namespace EricWoelki\Invision;

use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;

final class InvisionConnector extends Connector
{
    public function __construct(
        private readonly string $url,
        private readonly string $token,
    ) {}

    public function resolveBaseUrl(): string
    {
        return $this->url;
    }

    protected function defaultAuth(): BasicAuthenticator
    {
        return new BasicAuthenticator($this->token, '');
    }
}

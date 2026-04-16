<?php

declare(strict_types=1);

use EricWoelki\Invision\InvisionConnector;
use Saloon\Config;
use Saloon\Http\Faking\MockClient;
use Saloon\MockConfig;

Config::preventStrayRequests();
MockConfig::throwOnMissingFixtures();

function invisionMock(): InvisionConnector
{
    MockClient::destroyGlobal();

    return new InvisionConnector('http://invision.test/api', '::token::');
}

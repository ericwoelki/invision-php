<?php

declare(strict_types=1);

use EricWoelki\Invision\InvisionConnector;

it('sets a custom base url', function (): void {
    $connector = new InvisionConnector('https://example.com', '::token::');

    expect($connector->resolveBaseUrl())->toBe('https://example.com');
});

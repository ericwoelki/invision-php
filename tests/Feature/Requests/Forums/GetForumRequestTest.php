<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Forums\Requests\GetForumRequest;

it('resolves the endpoint', function (): void {
    $request = new GetForumRequest(1);

    expect($request->resolveEndpoint())->toBe('forums/forums/1');
});

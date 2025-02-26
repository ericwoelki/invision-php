<?php

declare(strict_types=1);

use EricWoelki\Invision\Payloads\Forums\ListForumsPayload;

it('can be serialized as an array with default arguments', function (): void {
    $payload = new ListForumsPayload;

    expect($payload->toArray())->toBe([
        'page' => 1,
        'perPage' => 25,
    ]);
});

it('can be serialized to as an array with custom arguments', function (): void {
    $payload = new ListForumsPayload(
        excludeClubForums: true,
        page: 2,
        perPage: 50,
    );

    expect($payload->toArray())->toBe([
        'clubs' => 0,
        'page' => 2,
        'perPage' => 50,
    ]);
});

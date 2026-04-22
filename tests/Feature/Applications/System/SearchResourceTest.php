<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Requests\ListSearchTypesRequest;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists search types', function (): void {
    MockClient::global([
        ListSearchTypesRequest::class => new InvisionFixture('system/search/types'),
    ]);

    $types = $this->invision->system()->search()->types();

    expect($types)
        ->toBeArray()
        ->each->toBeString();
});

<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Requests\ListClubsRequest;
use EricWoelki\Invision\Data\Club;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists clubs', function (): void {
    MockClient::global([
        ListClubsRequest::class => new InvisionFixture('system/clubs/list'),
    ]);

    $clubs = $this->invision->system()->clubs()->list();

    expect($clubs)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Club::class);
});

<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Requests\GetClubRequest;
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

it('gets a club', function (): void {
    MockClient::global([
        GetClubRequest::class => new InvisionFixture('system/clubs/get'),
    ]);

    $club = $this->invision->system()->clubs()->get(1);

    expect($club)->toBeInstanceOf(Club::class);
});

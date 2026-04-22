<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\CreateClubPayload;
use EricWoelki\Invision\Applications\System\Payloads\UpdateClubPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateClubRequest;
use EricWoelki\Invision\Applications\System\Requests\GetClubRequest;
use EricWoelki\Invision\Applications\System\Requests\ListClubsRequest;
use EricWoelki\Invision\Applications\System\Requests\UpdateClubRequest;
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

it('creates a club', function (): void {
    MockClient::global([
        CreateClubRequest::class => new InvisionFixture('system/clubs/create'),
    ]);

    $club = $this->invision->system()->clubs()->create(new CreateClubPayload(
        name: '::name::',
        ownerId: 2,
    ));

    expect($club)
        ->toBeInstanceOf(Club::class)
        ->and($club->name)->toBe('::name::');
});

it('updates a club', function (): void {
    MockClient::global([
        UpdateClubRequest::class => new InvisionFixture('system/clubs/update'),
    ]);

    $club = $this->invision->system()->clubs()->update(new UpdateClubPayload(
        clubId: 2,
        name: '::edited::',
    ));

    expect($club)
        ->toBeInstanceOf(Club::class)
        ->and($club->name)->toBe('::edited::');
});

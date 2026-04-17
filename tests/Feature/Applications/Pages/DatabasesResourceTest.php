<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Requests\GetDatabaseRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListDatabasesRequest;
use EricWoelki\Invision\Data\Database;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists databases', function (): void {
    MockClient::global([
        ListDatabasesRequest::class => new InvisionFixture('pages/databases/list'),
    ]);

    $databases = $this->invision->pages()->databases()->list();

    expect($databases)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Database::class);
});

it('gets a database', function (): void {
    MockClient::global([
        GetDatabaseRequest::class => new InvisionFixture('pages/databases/get'),
    ]);

    $database = $this->invision->pages()->databases()->get(1);

    expect($database)->toBeInstanceOf(Database::class);
});

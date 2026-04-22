<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Requests\ListEntriesRequest;
use EricWoelki\Invision\Data\Entry;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists entries', function (): void {
    MockClient::global([
        ListEntriesRequest::class => new InvisionFixture('blogs/entries/list'),
    ]);

    $entries = $this->invision->blogs()->entries()->list();

    expect($entries)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Entry::class);
});

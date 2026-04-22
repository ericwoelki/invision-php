<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateEntryPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateEntryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetEntryRequest;
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

it('gets an entry', function (): void {
    MockClient::global([
        GetEntryRequest::class => new InvisionFixture('blogs/entries/get'),
    ]);

    $entry = $this->invision->blogs()->entries()->get(1);

    expect($entry)->toBeInstanceOf(Entry::class);
});

it('creates an entry', function (): void {
    MockClient::global([
        CreateEntryRequest::class => new InvisionFixture('blogs/entries/create'),
    ]);

    $entry = $this->invision->blogs()->entries()->create(new CreateEntryPayload(
        blogId: 1,
        authorId: 1,
        title: '::title::',
        content: '::content::',
    ));

    expect($entry)
        ->toBeInstanceOf(Entry::class)
        ->and($entry->title)->toBe('::title::');
});

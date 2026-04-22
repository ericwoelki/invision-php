<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateEntryPayload;
use EricWoelki\Invision\Applications\Blogs\Payloads\UpdateEntryPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateEntryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\DeleteEntryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetEntryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListEntriesRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\UpdateEntryRequest;
use EricWoelki\Invision\Data\Entry;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
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

it('updates an entry', function (): void {
    MockClient::global([
        UpdateEntryRequest::class => new InvisionFixture('blogs/entries/update'),
    ]);

    $entry = $this->invision->blogs()->entries()->update(new UpdateEntryPayload(
        entryId: 2,
        title: '::edited::',
    ));

    expect($entry)
        ->toBeInstanceOf(Entry::class)
        ->and($entry->title)->toBe('::edited::');
});

it('deletes an entry', function (): void {
    $mock = MockClient::global([
        DeleteEntryRequest::class => MockResponse::make(),
    ]);

    $this->invision->blogs()->entries()->delete(1);

    $mock->assertSent(DeleteEntryRequest::class);
});

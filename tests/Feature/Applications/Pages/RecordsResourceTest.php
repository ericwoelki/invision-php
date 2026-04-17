<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\CreateRecordPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordsPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\UpdateRecordPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateRecordRequest;
use EricWoelki\Invision\Applications\Pages\Requests\GetRecordRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListRecordsRequest;
use EricWoelki\Invision\Applications\Pages\Requests\UpdateRecordRequest;
use EricWoelki\Invision\Data\Record;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists records', function (): void {
    MockClient::global([
        ListRecordsRequest::class => new InvisionFixture('pages/records/list'),
    ]);

    $records = $this->invision->pages()->records()->list(new ListRecordsPayload(
        databaseId: 1,
    ));

    expect($records)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Record::class);
});

it('gets a record', function (): void {
    MockClient::global([
        GetRecordRequest::class => new InvisionFixture('pages/records/get'),
    ]);

    $record = $this->invision->pages()->records()->get(databaseId: 1, recordId: 1);

    expect($record)->toBeInstanceOf(Record::class);
});

it('creates a record', function (): void {
    MockClient::global([
        CreateRecordRequest::class => new InvisionFixture('pages/records/create'),
    ]);

    $record = $this->invision->pages()->records()->create(new CreateRecordPayload(
        databaseId: 1,
        categoryId: 1,
        authorId: 1,
        fields: [
            1 => '::title::',
            2 => '::content::',
        ],
    ));

    expect($record)
        ->toBeInstanceOf(Record::class)
        ->and($record->title)->toBe('::title::');
});

it('updates a record', function (): void {
    MockClient::global([
        UpdateRecordRequest::class => new InvisionFixture('pages/records/update'),
    ]);

    $record = $this->invision->pages()->records()->update(new UpdateRecordPayload(
        databaseId: 1,
        recordId: 2,
        fields: [
            1 => '::edited::',
        ],
    ));

    expect($record)
        ->toBeInstanceOf(Record::class)
        ->and($record->title)->toBe('::edited::');
});

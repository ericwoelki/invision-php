<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\ListRecordsRequest;
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

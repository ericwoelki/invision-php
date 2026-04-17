<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\CreateRecordReactionPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateRecordReactionRequest;
use EricWoelki\Invision\Data\Record;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a record reaction', function (): void {
    MockClient::global([
        CreateRecordReactionRequest::class => new InvisionFixture('pages/records/reactions/create'),
    ]);

    $record = $this->invision->pages()->records()->reactions()->create(new CreateRecordReactionPayload(
        databaseId: 1,
        recordId: 1,
        memberId: 2,
        reactionId: 1,
    ));

    expect($record)->toBeInstanceOf(Record::class);
});

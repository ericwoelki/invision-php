<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordCommentsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\ListRecordCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists record comments', function (): void {
    MockClient::global([
        ListRecordCommentsRequest::class => new InvisionFixture('pages/records/comments/list'),
    ]);

    $comments = $this->invision->pages()->records()->comments()->list(new ListRecordCommentsPayload(
        databaseId: 1,
        recordId: 1,
    ));

    expect($comments)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Comment::class);
});

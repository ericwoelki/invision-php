<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Payloads\ListEntryCommentsPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\ListEntryCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists entry comments', function (): void {
    MockClient::global([
        ListEntryCommentsRequest::class => new InvisionFixture('blogs/entries/comments/list'),
    ]);

    $comments = $this->invision->blogs()->entries()->comments()->list(new ListEntryCommentsPayload(entryId: 1));

    expect($comments)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Comment::class);
});

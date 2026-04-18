<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\ListCommentsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\ListCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists comments', function (): void {
    MockClient::global([
        ListCommentsRequest::class => new InvisionFixture('pages/comments/list'),
    ]);

    $comments = $this->invision->pages()->comments()->list(new ListCommentsPayload(
        databaseId: 1,
    ));

    expect($comments)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Comment::class);
});

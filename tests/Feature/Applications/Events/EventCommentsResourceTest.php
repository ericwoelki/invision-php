<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\ListEventCommentsPayload;
use EricWoelki\Invision\Applications\Events\Requests\ListEventCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists event comments', function (): void {
    MockClient::global([
        ListEventCommentsRequest::class => new InvisionFixture('events/events/comments/list'),
    ]);

    $comments = $this->invision->events()->events()->comments()->list(new ListEventCommentsPayload(eventId: 1));

    expect($comments)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Comment::class);
});

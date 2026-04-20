<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Requests\GetCommentRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists comments', function (): void {
    MockClient::global([
        ListCommentsRequest::class => new InvisionFixture('events/comments/list'),
    ]);

    $comments = $this->invision->events()->comments()->list();

    expect($comments)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Comment::class);
});

it('gets a comment', function (): void {
    MockClient::global([
        GetCommentRequest::class => new InvisionFixture('events/comments/get'),
    ]);

    $comment = $this->invision->events()->comments()->get(1);

    expect($comment)->toBeInstanceOf(Comment::class);
});

<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\CreateCommentReactionPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateCommentReactionRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a comment reaction', function (): void {
    MockClient::global([
        CreateCommentReactionRequest::class => new InvisionFixture('events/comments/reactions/create'),
    ]);

    $comment = $this->invision->events()->comments()->reactions()->create(new CreateCommentReactionPayload(
        commentId: 2,
        memberId: 2,
        reactionId: 1,
    ));

    expect($comment)->toBeInstanceOf(Comment::class);
});

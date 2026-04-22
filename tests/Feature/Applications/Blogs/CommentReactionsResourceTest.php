<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateCommentReactionPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateCommentReactionRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a comment reaction', function (): void {
    MockClient::global([
        CreateCommentReactionRequest::class => new InvisionFixture('blogs/comments/reactions/create'),
    ]);

    $comment = $this->invision->blogs()->comments()->reactions()->create(new CreateCommentReactionPayload(
        commentId: 2,
        memberId: 2,
        reactionId: 1,
    ));

    expect($comment)->toBeInstanceOf(Comment::class);
});

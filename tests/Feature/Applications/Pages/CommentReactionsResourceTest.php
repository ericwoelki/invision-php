<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\CreateCommentReactionPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateCommentReactionRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a comment reaction', function (): void {
    MockClient::global([
        CreateCommentReactionRequest::class => new InvisionFixture('pages/comments/reactions/create'),
    ]);

    $comment = $this->invision->pages()->comments()->reactions()->create(new CreateCommentReactionPayload(
        databaseId: 1,
        commentId: 2,
        memberId: 1,
        reactionId: 1,
    ));

    expect($comment)->toBeInstanceOf(Comment::class);
});

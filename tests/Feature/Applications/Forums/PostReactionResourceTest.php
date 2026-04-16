<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostReactionPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\DeletePostReactionPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreatePostReactionRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeletePostReactionRequest;
use EricWoelki\Invision\Data\ReactedComment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a post reaction', function (): void {
    MockClient::global([
        CreatePostReactionRequest::class => new InvisionFixture('forums/posts/reactions/create'),
    ]);

    $reactedComment = $this->invision->forums()->posts()->reactions()->create(new CreatePostReactionPayload(
        postId: 2,
        memberId: 1,
        reactionId: 1,
    ));

    expect($reactedComment)->toBeInstanceOf(ReactedComment::class);
});

it('deletes a post reaction', function (): void {
    MockClient::global([
        DeletePostReactionRequest::class => new InvisionFixture('forums/posts/reactions/delete'),
    ]);

    $reactedComment = $this->invision->forums()->posts()->reactions()->delete(new DeletePostReactionPayload(
        postId: 2,
        memberId: 1,
    ));

    expect($reactedComment)->toBeInstanceOf(ReactedComment::class);
});

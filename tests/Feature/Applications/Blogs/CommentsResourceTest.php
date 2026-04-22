<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateCommentPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateCommentRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetCommentRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListCommentsRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists comments', function (): void {
    MockClient::global([
        ListCommentsRequest::class => new InvisionFixture('blogs/comments/list'),
    ]);

    $comments = $this->invision->blogs()->comments()->list();

    expect($comments)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Comment::class);
});

it('gets a comment', function (): void {
    MockClient::global([
        GetCommentRequest::class => new InvisionFixture('blogs/comments/get'),
    ]);

    $comment = $this->invision->blogs()->comments()->get(1);

    expect($comment)->toBeInstanceOf(Comment::class);
});

it('creates a comment', function (): void {
    MockClient::global([
        CreateCommentRequest::class => new InvisionFixture('blogs/comments/create'),
    ]);

    $comment = $this->invision->blogs()->comments()->create(new CreateCommentPayload(
        entryId: 2,
        authorId: 1,
        content: '::content::',
    ));

    expect($comment)
        ->toBeInstanceOf(Comment::class)
        ->and($comment->content)->toBe('::content::');
});

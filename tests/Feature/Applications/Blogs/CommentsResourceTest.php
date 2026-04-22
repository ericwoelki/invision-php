<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateCommentPayload;
use EricWoelki\Invision\Applications\Blogs\Payloads\UpdateCommentPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateCommentRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\DeleteCommentRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetCommentRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListCommentsRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\UpdateCommentRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
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

it('updates a comment', function (): void {
    MockClient::global([
        UpdateCommentRequest::class => new InvisionFixture('blogs/comments/update'),
    ]);

    $comment = $this->invision->blogs()->comments()->update(new UpdateCommentPayload(
        commentId: 2,
        content: '::edited::',
    ));

    expect($comment)
        ->toBeInstanceOf(Comment::class)
        ->and($comment->content)->toBe('::edited::');
});

it('deletes a comment', function (): void {
    $mock = MockClient::global([
        DeleteCommentRequest::class => MockResponse::make(),
    ]);

    $this->invision->blogs()->comments()->delete(1);

    $mock->assertSent(DeleteCommentRequest::class);
});

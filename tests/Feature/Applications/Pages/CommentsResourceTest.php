<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\CreateCommentPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\ListCommentsPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\UpdateCommentPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateCommentRequest;
use EricWoelki\Invision\Applications\Pages\Requests\DeleteCommentRequest;
use EricWoelki\Invision\Applications\Pages\Requests\GetCommentRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListCommentsRequest;
use EricWoelki\Invision\Applications\Pages\Requests\UpdateCommentRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
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

it('gets a comment', function (): void {
    MockClient::global([
        GetCommentRequest::class => new InvisionFixture('pages/comments/get'),
    ]);

    $comment = $this->invision->pages()->comments()->get(databaseId: 1, commentId: 1);

    expect($comment)->toBeInstanceOf(Comment::class);
});

it('creates a comment', function (): void {
    MockClient::global([
        CreateCommentRequest::class => new InvisionFixture('pages/comments/create'),
    ]);

    $comment = $this->invision->pages()->comments()->create(new CreateCommentPayload(
        databaseId: 1,
        recordId: 2,
        authorId: 2,
        content: '::content::',
    ));

    expect($comment)
        ->toBeInstanceOf(Comment::class)
        ->and($comment->content)->toBe('::content::');
});

it('updates a comment', function (): void {
    MockClient::global([
        UpdateCommentRequest::class => new InvisionFixture('pages/comments/update'),
    ]);

    $comment = $this->invision->pages()->comments()->update(new UpdateCommentPayload(
        databaseId: 1,
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

    $this->invision->pages()->comments()->delete(databaseId: 1, commentId: 1);

    $mock->assertSent(DeleteCommentRequest::class);
});

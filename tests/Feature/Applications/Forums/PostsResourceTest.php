<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\UpdatePostPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreatePostRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeletePostRequest;
use EricWoelki\Invision\Applications\Forums\Requests\GetPostRequest;
use EricWoelki\Invision\Applications\Forums\Requests\ListPostsRequest;
use EricWoelki\Invision\Applications\Forums\Requests\UpdatePostRequest;
use EricWoelki\Invision\Data\Post;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists posts', function (): void {
    MockClient::global([
        ListPostsRequest::class => new InvisionFixture('forums/posts/list'),
    ]);

    $posts = $this->invision->forums()->posts()->list();

    expect($posts)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Post::class);
});

it('gets a post', function (): void {
    MockClient::global([
        GetPostRequest::class => new InvisionFixture('forums/posts/get'),
    ]);

    $post = $this->invision->forums()->posts()->get(1);

    expect($post)->toBeInstanceOf(Post::class);
});

it('creates a post', function (): void {
    MockClient::global([
        CreatePostRequest::class => new InvisionFixture('forums/posts/create'),
    ]);

    $post = $this->invision->forums()->posts()->create(new CreatePostPayload(
        topicId: 7,
        authorId: 1,
        content: '::content::',
    ));

    expect($post)
        ->toBeInstanceOf(Post::class)
        ->and($post->content)->toBe('::content::');
});

it('updates a post', function (): void {
    MockClient::global([
        UpdatePostRequest::class => new InvisionFixture('forums/posts/update'),
    ]);

    $post = $this->invision->forums()->posts()->update(new UpdatePostPayload(
        postId: 10,
        content: '::edited::',
    ));

    expect($post)
        ->toBeInstanceOf(Post::class)
        ->and($post->content)->toBe('::edited::');
});

it('deletes a post', function (): void {
    $mock = MockClient::global([
        DeletePostRequest::class => MockResponse::make(),
    ]);

    $this->invision->forums()->posts()->delete(1);

    $mock->assertSent(DeletePostRequest::class);
});

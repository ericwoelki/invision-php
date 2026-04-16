<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Forums\Payloads\CreateForumPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\DeleteForumPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\UpdateForumPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreateForumRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeleteForumRequest;
use EricWoelki\Invision\Applications\Forums\Requests\GetForumRequest;
use EricWoelki\Invision\Applications\Forums\Requests\ListForumsRequest;
use EricWoelki\Invision\Applications\Forums\Requests\UpdateForumRequest;
use EricWoelki\Invision\Data\Forum;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists forums', function (): void {
    MockClient::global([
        ListForumsRequest::class => new InvisionFixture('forums/forums/list'),
    ]);

    $forums = $this->invision->forums()->forums()->list();

    expect($forums)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Forum::class);
});

it('gets a forum', function (): void {
    MockClient::global([
        GetForumRequest::class => new InvisionFixture('forums/forums/get'),
    ]);

    $forum = $this->invision->forums()->forums()->get(1);

    expect($forum)->toBeInstanceOf(Forum::class);
});

it('creates a forum', function (): void {
    MockClient::global([
        CreateForumRequest::class => new InvisionFixture('forums/forums/create'),
    ]);

    $forum = $this->invision->forums()->forums()->create(new CreateForumPayload(
        title: '::title::',
    ));

    expect($forum)
        ->toBeInstanceOf(Forum::class)
        ->and($forum->name)->toBe('::title::');
});

it('updates a forum', function (): void {
    MockClient::global([
        UpdateForumRequest::class => new InvisionFixture('forums/forums/update'),
    ]);

    $forum = $this->invision->forums()->forums()->update(new UpdateForumPayload(
        forumId: 1,
        title: '::title::',
    ));
    expect($forum)
        ->toBeInstanceOf(Forum::class)
        ->and($forum->name)->toBe('::title::');
});

it('deletes a forum', function (): void {
    $mock = MockClient::global([
        DeleteForumRequest::class => MockResponse::make(),
    ]);

    $this->invision->forums()->forums()->delete(new DeleteForumPayload(
        forumId: 1,
        deleteChildren: true,
    ));

    $mock->assertSent(DeleteForumRequest::class);
});

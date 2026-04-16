<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Forums\Payloads\CreateTopicPayload;
use EricWoelki\Invision\Applications\Forums\Payloads\UpdateTopicPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreateTopicRequest;
use EricWoelki\Invision\Applications\Forums\Requests\DeleteTopicRequest;
use EricWoelki\Invision\Applications\Forums\Requests\GetTopicRequest;
use EricWoelki\Invision\Applications\Forums\Requests\ListTopicsRequest;
use EricWoelki\Invision\Applications\Forums\Requests\UpdateTopicRequest;
use EricWoelki\Invision\Data\Topic;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists topics', function (): void {
    MockClient::global([
        ListTopicsRequest::class => new InvisionFixture('forums/topics/list'),
    ]);

    $topics = $this->invision->forums()->topics()->list();

    expect($topics)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Topic::class);
});

it('gets a topic', function (): void {
    MockClient::global([
        GetTopicRequest::class => new InvisionFixture('forums/topics/get'),
    ]);

    $topic = $this->invision->forums()->topics()->get(1);

    expect($topic)->toBeInstanceOf(Topic::class);
});

it('creates a topic', function (): void {
    MockClient::global([
        CreateTopicRequest::class => new InvisionFixture('forums/topics/create'),
    ]);

    $topic = $this->invision->forums()->topics()->create(new CreateTopicPayload(
        forumId: 2,
        title: '::title::',
        content: '::content::',
        authorId: 1,
    ));

    expect($topic)
        ->toBeInstanceOf(Topic::class)
        ->and($topic->title)->toBe('::title::');
});

it('updates a topic', function (): void {
    MockClient::global([
        UpdateTopicRequest::class => new InvisionFixture('forums/topics/update'),
    ]);

    $topic = $this->invision->forums()->topics()->update(new UpdateTopicPayload(
        topicId: 7,
        content: '::edited::',
    ));

    expect($topic)
        ->toBeInstanceOf(Topic::class)
        ->and($topic->firstPost->content)->toBe('::edited::');
});

it('deletes a topic', function (): void {
    $mock = MockClient::global([
        DeleteTopicRequest::class => MockResponse::make(),
    ]);

    $this->invision->forums()->topics()->delete(1);

    $mock->assertSent(DeleteTopicRequest::class);
});

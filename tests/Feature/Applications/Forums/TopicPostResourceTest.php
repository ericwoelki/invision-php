<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Forums\Payloads\ListTopicPostsPayload;
use EricWoelki\Invision\Applications\Forums\Requests\ListTopicPostsRequest;
use EricWoelki\Invision\Data\Post;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists topic posts', function (): void {
    MockClient::global([
        ListTopicPostsRequest::class => new InvisionFixture('forums/topics/posts/list'),
    ]);

    $posts = $this->invision->forums()->topics()->posts()->list(new ListTopicPostsPayload(
        topicId: 1,
    ));

    expect($posts)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Post::class);
});

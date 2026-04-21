<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Forums\Payloads\CreatePostReportPayload;
use EricWoelki\Invision\Applications\Forums\Requests\CreatePostReportRequest;
use EricWoelki\Invision\Data\Post;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a post report', function (): void {
    MockClient::global([
        CreatePostReportRequest::class => new InvisionFixture('forums/posts/reports/create'),
    ]);

    $post = $this->invision->forums()->posts()->reports()->create(new CreatePostReportPayload(
        postId: 2,
        reporterId: 1,
    ));

    expect($post)->toBeInstanceOf(Post::class);
});

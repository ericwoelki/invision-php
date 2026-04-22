<?php

declare(strict_types=1);

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

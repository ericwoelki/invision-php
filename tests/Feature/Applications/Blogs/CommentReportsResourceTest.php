<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateCommentReportPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateCommentReportRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a comment report', function (): void {
    MockClient::global([
        CreateCommentReportRequest::class => new InvisionFixture('blogs/comments/reports/create'),
    ]);

    $comment = $this->invision->blogs()->comments()->reports()->create(new CreateCommentReportPayload(
        commentId: 2,
        reporterId: 1,
    ));

    expect($comment)->toBeInstanceOf(Comment::class);
});

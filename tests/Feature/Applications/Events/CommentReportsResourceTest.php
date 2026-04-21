<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\CreateCommentReportPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateCommentReportRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a comment report', function (): void {
    MockClient::global([
        CreateCommentReportRequest::class => new InvisionFixture('events/comments/reports/create'),
    ]);

    $comment = $this->invision->events()->comments()->reports()->create(new CreateCommentReportPayload(
        commentId: 2,
        reporterId: 2,
    ));

    expect($comment)->toBeInstanceOf(Comment::class);
});

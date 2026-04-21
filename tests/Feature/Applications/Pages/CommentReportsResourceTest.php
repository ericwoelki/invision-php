<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\CreateCommentReportPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateCommentReportRequest;
use EricWoelki\Invision\Data\Comment;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a comment report', function (): void {
    MockClient::global([
        CreateCommentReportRequest::class => new InvisionFixture('pages/comments/reports/create'),
    ]);

    $comment = $this->invision->pages()->comments()->reports()->create(new CreateCommentReportPayload(
        databaseId: 1,
        commentId: 2,
        reporterId: 1,
    ));

    expect($comment)->toBeInstanceOf(Comment::class);
});

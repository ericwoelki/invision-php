<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\CreateReviewReportPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateReviewReportRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a review report', function (): void {
    MockClient::global([
        CreateReviewReportRequest::class => new InvisionFixture('events/reviews/reports/create'),
    ]);

    $review = $this->invision->events()->reviews()->reports()->create(new CreateReviewReportPayload(
        reviewId: 2,
        reporterId: 1,
    ));

    expect($review)->toBeInstanceOf(Review::class);
});

<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\ListEventReviewsPayload;
use EricWoelki\Invision\Applications\Events\Requests\ListEventReviewsRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists event reviews', function (): void {
    MockClient::global([
        ListEventReviewsRequest::class => new InvisionFixture('events/events/reviews/list'),
    ]);

    $reviews = $this->invision->events()->events()->reviews()->list(new ListEventReviewsPayload(eventId: 1));

    expect($reviews)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Review::class);
});

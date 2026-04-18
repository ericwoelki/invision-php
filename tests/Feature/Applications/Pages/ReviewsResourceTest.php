<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\ListReviewsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\GetReviewRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListReviewsRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists reviews', function (): void {
    MockClient::global([
        ListReviewsRequest::class => new InvisionFixture('pages/reviews/list'),
    ]);

    $reviews = $this->invision->pages()->reviews()->list(new ListReviewsPayload(databaseId: 1));

    expect($reviews)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Review::class);
});

it('gets a review', function (): void {
    MockClient::global([
        GetReviewRequest::class => new InvisionFixture('pages/reviews/get'),
    ]);

    $review = $this->invision->pages()->reviews()->get(databaseId: 1, reviewId: 1);

    expect($review)->toBeInstanceOf(Review::class);
});

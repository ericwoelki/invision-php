<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Requests\ListReviewsRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists reviews', function (): void {
    MockClient::global([
        ListReviewsRequest::class => new InvisionFixture('events/reviews/list'),
    ]);

    $reviews = $this->invision->events()->reviews()->list();

    expect($reviews)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Review::class);
});

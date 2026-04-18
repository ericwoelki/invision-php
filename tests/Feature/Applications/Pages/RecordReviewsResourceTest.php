<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\ListRecordReviewsPayload;
use EricWoelki\Invision\Applications\Pages\Requests\ListRecordReviewsRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists record reviews', function (): void {
    MockClient::global([
        ListRecordReviewsRequest::class => new InvisionFixture('pages/records/reviews/list'),
    ]);

    $reviews = $this->invision->pages()->records()->reviews()->list(new ListRecordReviewsPayload(
        databaseId: 1,
        recordId: 2,
    ));

    expect($reviews)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Review::class);
});

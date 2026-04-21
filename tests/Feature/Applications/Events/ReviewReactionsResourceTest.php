<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\CreateReviewReactionPayload;
use EricWoelki\Invision\Applications\Events\Payloads\DeleteReviewReactionPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateReviewReactionRequest;
use EricWoelki\Invision\Applications\Events\Requests\DeleteReviewReactionRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a review reaction', function (): void {
    MockClient::global([
        CreateReviewReactionRequest::class => new InvisionFixture('events/reviews/reactions/create'),
    ]);

    $review = $this->invision->events()->reviews()->reactions()->create(new CreateReviewReactionPayload(
        reviewId: 2,
        memberId: 1,
        reactionId: 1,
    ));

    expect($review)->toBeInstanceOf(Review::class);
});

it('deletes a review reaction', function (): void {
    MockClient::global([
        DeleteReviewReactionRequest::class => new InvisionFixture('events/reviews/reactions/delete'),
    ]);

    $review = $this->invision->events()->reviews()->reactions()->delete(new DeleteReviewReactionPayload(
        reviewId: 2,
        memberId: 1,
    ));

    expect($review)->toBeInstanceOf(Review::class);
});

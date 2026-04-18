<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Payloads\CreateReviewPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\ListReviewsPayload;
use EricWoelki\Invision\Applications\Pages\Payloads\UpdateReviewPayload;
use EricWoelki\Invision\Applications\Pages\Requests\CreateReviewRequest;
use EricWoelki\Invision\Applications\Pages\Requests\DeleteReviewRequest;
use EricWoelki\Invision\Applications\Pages\Requests\GetReviewRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListReviewsRequest;
use EricWoelki\Invision\Applications\Pages\Requests\UpdateReviewRequest;
use EricWoelki\Invision\Data\Review;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
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

it('creates a review', function (): void {
    MockClient::global([
        CreateReviewRequest::class => new InvisionFixture('pages/reviews/create'),
    ]);

    $review = $this->invision->pages()->reviews()->create(new CreateReviewPayload(
        databaseId: 1,
        recordId: 1,
        authorId: 2,
        content: '::content::',
        rating: 4,
    ));

    expect($review)
        ->toBeInstanceOf(Review::class)
        ->and($review->rating)->toBe(4);
});

it('updates a review', function (): void {
    MockClient::global([
        UpdateReviewRequest::class => new InvisionFixture('pages/reviews/update'),
    ]);

    $review = $this->invision->pages()->reviews()->update(new UpdateReviewPayload(
        databaseId: 1,
        reviewId: 1,
        content: '::edited::',
    ));

    expect($review)
        ->toBeInstanceOf(Review::class)
        ->and($review->content)->toBe('::edited::');
});

it('deletes a review', function (): void {
    $mock = MockClient::global([
        DeleteReviewRequest::class => MockResponse::make(),
    ]);

    $this->invision->pages()->reviews()->delete(databaseId: 1, reviewId: 1);

    $mock->assertSent(DeleteReviewRequest::class);
});

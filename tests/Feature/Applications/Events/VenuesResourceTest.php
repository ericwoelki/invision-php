<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\CreateVenuePayload;
use EricWoelki\Invision\Applications\Events\Payloads\UpdateVenuePayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateVenueRequest;
use EricWoelki\Invision\Applications\Events\Requests\DeleteVenueRequest;
use EricWoelki\Invision\Applications\Events\Requests\GetVenueRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListVenuesRequest;
use EricWoelki\Invision\Applications\Events\Requests\UpdateVenueRequest;
use EricWoelki\Invision\Data\Geolocation;
use EricWoelki\Invision\Data\Venue;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists venues', function (): void {
    MockClient::global([
        ListVenuesRequest::class => new InvisionFixture('events/venues/list'),
    ]);

    $venues = $this->invision->events()->venues()->list();

    expect($venues)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Venue::class);
});

it('gets a venue', function (): void {
    MockClient::global([
        GetVenueRequest::class => new InvisionFixture('events/venues/get'),
    ]);

    $venue = $this->invision->events()->venues()->get(1);

    expect($venue)->toBeInstanceOf(Venue::class);
});

it('creates a venue', function (): void {
    MockClient::global([
        CreateVenueRequest::class => new InvisionFixture('events/venues/create'),
    ]);

    $venue = $this->invision->events()->venues()->create(new CreateVenuePayload(
        title: '::title::',
        address: new Geolocation(
            country: 'GB',
        ),
    ));

    expect($venue)
        ->toBeInstanceOf(Venue::class)
        ->and($venue->title)->toBe('::title::');
});

it('updates a venue', function (): void {
    MockClient::global([
        UpdateVenueRequest::class => new InvisionFixture('events/venues/update'),
    ]);

    $venue = $this->invision->events()->venues()->update(new UpdateVenuePayload(
        venueId: 1,
        title: '::edited::',
    ));

    expect($venue)
        ->toBeInstanceOf(Venue::class)
        ->and($venue->title)->toBe('::edited::');
});

it('deletes a venue', function (): void {
    $mock = MockClient::global([
        DeleteVenueRequest::class => MockResponse::make(),
    ]);

    $this->invision->events()->venues()->delete(1);

    $mock->assertSent(DeleteVenueRequest::class);
});

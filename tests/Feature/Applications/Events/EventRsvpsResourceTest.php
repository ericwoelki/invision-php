<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\CreateEventRsvpPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateEventRsvpRequest;
use EricWoelki\Invision\Applications\Events\Requests\DeleteEventRsvpRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListEventRsvpsRequest;
use EricWoelki\Invision\Data\EventRsvps;
use EricWoelki\Invision\Enums\EventAttendance;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists event rsvps', function (): void {
    MockClient::global([
        ListEventRsvpsRequest::class => new InvisionFixture('events/events/rsvps/list'),
    ]);

    $rsvps = $this->invision->events()->events()->rsvps()->list(3);

    expect($rsvps)->toBeInstanceOf(EventRsvps::class);
});

it('creates an event rsvp', function (): void {
    $mock = MockClient::global([
        CreateEventRsvpRequest::class => MockResponse::make(),
    ]);

    $this->invision->events()->events()->rsvps()->create(new CreateEventRsvpPayload(
        eventId: 1,
        memberId: 1,
        attendance: EventAttendance::Yes,
    ));

    $mock->assertSent(CreateEventRsvpRequest::class);
});

it('deletes an event rsvp', function (): void {
    $mock = MockClient::global([
        DeleteEventRsvpRequest::class => MockResponse::make(),
    ]);

    $this->invision->events()->events()->rsvps()->delete(eventId: 1, memberId: 1);

    $mock->assertSent(DeleteEventRsvpRequest::class);
});

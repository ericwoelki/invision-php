<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\CreateEventRSVPPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateEventRSVPRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListEventRSVPsRequest;
use EricWoelki\Invision\Data\EventRSVPs;
use EricWoelki\Invision\Enums\EventAttendance;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists event rsvps', function (): void {
    MockClient::global([
        ListEventRSVPsRequest::class => new InvisionFixture('events/events/rsvps/list'),
    ]);

    $rsvps = $this->invision->events()->events()->rsvps()->list(3);

    expect($rsvps)->toBeInstanceOf(EventRSVPs::class);
});

it('creates an event rsvp', function (): void {
    $mock = MockClient::global([
        CreateEventRSVPRequest::class => MockResponse::make(),
    ]);

    $this->invision->events()->events()->rsvps()->create(new CreateEventRSVPPayload(
        eventId: 1,
        memberId: 1,
        attendance: EventAttendance::Yes,
    ));

    $mock->assertSent(CreateEventRSVPRequest::class);
});

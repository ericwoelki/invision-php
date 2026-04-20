<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Requests\GetEventRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListEventsRequest;
use EricWoelki\Invision\Data\Event;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists events', function (): void {
    MockClient::global([
        ListEventsRequest::class => new InvisionFixture('events/events/list'),
    ]);

    $events = $this->invision->events()->events()->list();

    expect($events)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Event::class);
});

it('gets an event', function (): void {
    MockClient::global([
        GetEventRequest::class => new InvisionFixture('events/events/get'),
    ]);

    $event = $this->invision->events()->events()->get(1);

    expect($event)->toBeInstanceOf(Event::class);
});

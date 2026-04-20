<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use EricWoelki\Invision\Applications\Events\Payloads\CreateEventPayload;
use EricWoelki\Invision\Applications\Events\Payloads\UpdateEventPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateEventRequest;
use EricWoelki\Invision\Applications\Events\Requests\DeleteEventRequest;
use EricWoelki\Invision\Applications\Events\Requests\GetEventRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListEventsRequest;
use EricWoelki\Invision\Applications\Events\Requests\UpdateEventRequest;
use EricWoelki\Invision\Data\Event;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
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

it('creates an event', function (): void {
    MockClient::global([
        CreateEventRequest::class => new InvisionFixture('events/events/create'),
    ]);

    $event = $this->invision->events()->events()->create(new CreateEventPayload(
        calendarId: 1,
        title: '::title::',
        description: '::description::',
        authorId: 1,
        start: CarbonImmutable::now()->addDays(3)->toIso8601String(),
    ));

    expect($event)
        ->toBeInstanceOf(Event::class)
        ->and($event->title)->toBe('::title::');
});

it('updates an event', function (): void {
    MockClient::global([
        UpdateEventRequest::class => new InvisionFixture('events/events/update'),
    ]);

    $event = $this->invision->events()->events()->update(new UpdateEventPayload(
        eventId: 2,
        calendarId: 1,
        title: '::edited::',
        description: '::description::',
        authorId: 1,
        start: CarbonImmutable::now()->addDays(3)->startOfDay()->toIso8601String(),
    ));

    expect($event)
        ->toBeInstanceOf(Event::class)
        ->and($event->title)->toBe('::edited::');
});

it('deletes an event', function (): void {
    $mock = MockClient::global([
        DeleteEventRequest::class => MockResponse::make(),
    ]);

    $this->invision->events()->events()->delete(1);

    $mock->assertSent(DeleteEventRequest::class);
});

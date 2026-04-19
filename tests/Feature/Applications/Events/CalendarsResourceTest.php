<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Payloads\CreateCalendarPayload;
use EricWoelki\Invision\Applications\Events\Payloads\UpdateCalendarPayload;
use EricWoelki\Invision\Applications\Events\Requests\CreateCalendarRequest;
use EricWoelki\Invision\Applications\Events\Requests\GetCalendarRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListCalendarsRequest;
use EricWoelki\Invision\Applications\Events\Requests\UpdateCalendarRequest;
use EricWoelki\Invision\Data\Calendar;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists calendars', function (): void {
    MockClient::global([
        ListCalendarsRequest::class => new InvisionFixture('events/calendars/list'),
    ]);

    $calendars = $this->invision->events()->calendars()->list();

    expect($calendars)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Calendar::class);
});

it('gets a calendar', function (): void {
    MockClient::global([
        GetCalendarRequest::class => new InvisionFixture('events/calendars/get'),
    ]);

    $calendar = $this->invision->events()->calendars()->get(1);

    expect($calendar)->toBeInstanceOf(Calendar::class);
});

it('creates a calendar', function (): void {
    MockClient::global([
        CreateCalendarRequest::class => new InvisionFixture('events/calendars/create'),
    ]);

    $calendar = $this->invision->events()->calendars()->create(new CreateCalendarPayload(
        title: '::title::',
    ));

    expect($calendar)
        ->toBeInstanceOf(Calendar::class)
        ->and($calendar->name)->toBe('::title::');
});

it('updates a calendar', function (): void {
    MockClient::global([
        UpdateCalendarRequest::class => new InvisionFixture('events/calendars/update'),
    ]);

    $calendar = $this->invision->events()->calendars()->update(new UpdateCalendarPayload(
        calendarId: 2,
        title: '::edited::',
    ));

    expect($calendar)
        ->toBeInstanceOf(Calendar::class)
        ->and($calendar->name)->toBe('::edited::');
});

<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Requests\GetCalendarRequest;
use EricWoelki\Invision\Applications\Events\Requests\ListCalendarsRequest;
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

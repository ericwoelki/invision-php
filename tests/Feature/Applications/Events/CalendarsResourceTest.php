<?php

declare(strict_types=1);

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

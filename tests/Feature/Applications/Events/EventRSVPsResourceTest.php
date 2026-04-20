<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Requests\ListEventRSVPsRequest;
use EricWoelki\Invision\Data\EventRSVPs;
use Saloon\Http\Faking\MockClient;
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

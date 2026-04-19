<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Events\Requests\ListVenuesRequest;
use EricWoelki\Invision\Data\Venue;
use Saloon\Http\Faking\MockClient;
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

<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Requests\ListClubMembersRequest;
use EricWoelki\Invision\Data\ClubMembership;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists club members', function (): void {
    MockClient::global([
        ListClubMembersRequest::class => new InvisionFixture('system/clubs/members/list'),
    ]);

    $membership = $this->invision->system()->clubs()->members()->list(1);

    expect($membership)->toBeInstanceOf(ClubMembership::class);
});

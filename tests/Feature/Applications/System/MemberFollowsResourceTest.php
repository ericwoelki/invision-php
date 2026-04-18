<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\ListMemberFollowsPayload;
use EricWoelki\Invision\Applications\System\Requests\ListMemberFollowsRequest;
use EricWoelki\Invision\Data\Follow;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists member follows', function (): void {
    MockClient::global([
        ListMemberFollowsRequest::class => new InvisionFixture('system/members/follows/list'),
    ]);

    $follows = $this->invision->system()->members()->follows()->list(new ListMemberFollowsPayload(memberId: 1));

    expect($follows)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Follow::class);
});

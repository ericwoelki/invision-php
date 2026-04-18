<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberFollowPayload;
use EricWoelki\Invision\Applications\System\Payloads\ListMemberFollowsPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMemberFollowRequest;
use EricWoelki\Invision\Applications\System\Requests\DeleteMemberFollowRequest;
use EricWoelki\Invision\Applications\System\Requests\ListMemberFollowsRequest;
use EricWoelki\Invision\Data\Follow;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
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

it('creates a member follow', function (): void {
    MockClient::global([
        CreateMemberFollowRequest::class => new InvisionFixture('system/members/follows/create'),
    ]);

    $follow = $this->invision->system()->members()->follows()->create(new CreateMemberFollowPayload(
        memberId: 1,
        application: 'forums',
        area: 'topic',
        itemId: 1,
    ));

    expect($follow)->toBeInstanceOf(Follow::class);
});

it('deletes a member follow', function (): void {
    $mock = MockClient::global([
        DeleteMemberFollowRequest::class => MockResponse::make(),
    ]);

    $this->invision->system()->members()->follows()->delete(memberId: 1, followId: '::follow::');

    $mock->assertSent(DeleteMemberFollowRequest::class);
});

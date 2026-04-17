<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Requests\DeleteGroupRequest;
use EricWoelki\Invision\Applications\System\Requests\GetGroupRequest;
use EricWoelki\Invision\Applications\System\Requests\ListGroupsRequest;
use EricWoelki\Invision\Data\Group;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists groups', function (): void {
    MockClient::global([
        ListGroupsRequest::class => new InvisionFixture('system/groups/list'),
    ]);

    $groups = $this->invision->system()->groups()->list();

    expect($groups)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Group::class);
});

it('gets a group', function (): void {
    MockClient::global([
        GetGroupRequest::class => new InvisionFixture('system/groups/get'),
    ]);

    $group = $this->invision->system()->groups()->get(4);

    expect($group)->toBeInstanceOf(Group::class);
});

it('deletes a group', function (): void {
    $mock = MockClient::global([
        DeleteGroupRequest::class => MockResponse::make(),
    ]);

    $this->invision->system()->groups()->delete(10);

    $mock->assertSent(DeleteGroupRequest::class);
});

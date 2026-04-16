<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberPayload;
use EricWoelki\Invision\Applications\System\Payloads\UpdateMemberPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMemberRequest;
use EricWoelki\Invision\Applications\System\Requests\GetMemberRequest;
use EricWoelki\Invision\Applications\System\Requests\ListMembersRequest;
use EricWoelki\Invision\Applications\System\Requests\UpdateMemberRequest;
use EricWoelki\Invision\Data\Member;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists members', function (): void {
    MockClient::global([
        ListMembersRequest::class => new InvisionFixture('system/members/list'),
    ]);

    $members = $this->invision->system()->members()->list();

    expect($members)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Member::class);
});

it('gets a member', function (): void {
    MockClient::global([
        GetMemberRequest::class => new InvisionFixture('system/members/get'),
    ]);

    $member = $this->invision->system()->members()->get(1);

    expect($member)->toBeInstanceOf(Member::class);
});

it('creates a member', function (): void {
    MockClient::global([
        CreateMemberRequest::class => new InvisionFixture('system/members/create'),
    ]);

    $member = $this->invision->system()->members()->create(new CreateMemberPayload(
        name: '::name::',
        email: '::email::',
    ));

    expect($member)
        ->toBeInstanceOf(Member::class)
        ->and($member->name)->toBe('::name::');
});

it('updates a member', function (): void {
    MockClient::global([
        UpdateMemberRequest::class => new InvisionFixture('system/members/update'),
    ]);

    $member = $this->invision->system()->members()->update(new UpdateMemberPayload(
        memberId: 3,
        name: '::edited::',
    ));

    expect($member)
        ->toBeInstanceOf(Member::class)
        ->and($member->name)->toBe('::edited::');
});

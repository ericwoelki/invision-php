<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberWarningPayload;
use EricWoelki\Invision\Applications\System\Payloads\DeleteMemberWarningPayload;
use EricWoelki\Invision\Applications\System\Payloads\ListMemberWarningsPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMemberWarningRequest;
use EricWoelki\Invision\Applications\System\Requests\DeleteMemberWarningRequest;
use EricWoelki\Invision\Applications\System\Requests\GetMemberWarningRequest;
use EricWoelki\Invision\Applications\System\Requests\ListMemberWarningsRequest;
use EricWoelki\Invision\Data\Warning;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists member warnings', function (): void {
    MockClient::global([
        ListMemberWarningsRequest::class => new InvisionFixture('system/members/warnings/list'),
    ]);

    $warnings = $this->invision->system()->members()->warnings()->list(new ListMemberWarningsPayload(memberId: 2));

    expect($warnings)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Warning::class);
});

it('gets a member warning', function (): void {
    MockClient::global([
        GetMemberWarningRequest::class => new InvisionFixture('system/members/warnings/get'),
    ]);

    $warning = $this->invision->system()->members()->warnings()->get(memberId: 2, warningId: 1);

    expect($warning)->toBeInstanceOf(Warning::class);
});

it('creates a member warning', function (): void {
    MockClient::global([
        CreateMemberWarningRequest::class => new InvisionFixture('system/members/warnings/create'),
    ]);

    $warning = $this->invision->system()->members()->warnings()->create(new CreateMemberWarningPayload(
        memberId: 2,
        moderatorId: 1,
    ));

    expect($warning)->toBeInstanceOf(Warning::class);
});

it('deletes a member warning', function (): void {
    $mock = MockClient::global([
        DeleteMemberWarningRequest::class => MockResponse::make(),
    ]);

    $this->invision->system()->members()->warnings()->delete(new DeleteMemberWarningPayload(
        memberId: 2,
        warningId: 2,
    ));

    $mock->assertSent(DeleteMemberWarningRequest::class);
});

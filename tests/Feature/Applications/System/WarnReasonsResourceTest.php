<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Requests\GetWarnReasonRequest;
use EricWoelki\Invision\Applications\System\Requests\ListWarnReasonsRequest;
use EricWoelki\Invision\Data\WarnReason;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists warn reasons', function (): void {
    MockClient::global([
        ListWarnReasonsRequest::class => new InvisionFixture('system/warn-reasons/list'),
    ]);

    $reasons = $this->invision->system()->warnReasons()->list();

    expect($reasons)
        ->toBeArray()
        ->toContainOnlyInstancesOf(WarnReason::class);
});

it('gets a warn reason', function (): void {
    MockClient::global([
        GetWarnReasonRequest::class => new InvisionFixture('system/warn-reasons/get'),
    ]);

    $reason = $this->invision->system()->warnReasons()->get(1);

    expect($reason)->toBeInstanceOf(WarnReason::class);
});

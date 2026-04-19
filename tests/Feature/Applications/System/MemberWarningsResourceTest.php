<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\ListMemberWarningsPayload;
use EricWoelki\Invision\Applications\System\Requests\ListMemberWarningsRequest;
use EricWoelki\Invision\Data\Warning;
use Saloon\Http\Faking\MockClient;
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

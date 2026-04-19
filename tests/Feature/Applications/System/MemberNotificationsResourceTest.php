<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\ListMemberNotificationsPayload;
use EricWoelki\Invision\Applications\System\Requests\ListMemberNotificationsRequest;
use EricWoelki\Invision\Data\Notification;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists member notifications', function (): void {
    MockClient::global([
        ListMemberNotificationsRequest::class => new InvisionFixture('system/members/notifications/list'),
    ]);

    $notifications = $this->invision->system()->members()->notifications()->list(new ListMemberNotificationsPayload(
        memberId: 1,
    ));

    expect($notifications)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Notification::class);
});

<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\CreateMessageReplyPayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMessageReplyRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a message reply', function (): void {
    $mock = MockClient::global([
        CreateMessageReplyRequest::class => MockResponse::make(),
    ]);

    $this->invision->system()->messages()->replies()->create(new CreateMessageReplyPayload(
        messageId: 1,
        senderId: 1,
        body: '::body::',
    ));

    $mock->assertSent(CreateMessageReplyRequest::class);
});

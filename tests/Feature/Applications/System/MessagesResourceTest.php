<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\CreateMessagePayload;
use EricWoelki\Invision\Applications\System\Requests\CreateMessageRequest;
use EricWoelki\Invision\Applications\System\Requests\DeleteMessageRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('creates a message', function (): void {
    $m = MockClient::global([
        CreateMessageRequest::class => MockResponse::make(status: 201),
    ]);

    $this->invision->system()->messages()->create(new CreateMessagePayload(
        senderId: 2,
        recipientIds: [1],
        title: '::title::',
        body: '::body::',
    ));

    $m->assertSent(CreateMessageRequest::class);
});

it('deletes a message', function (): void {
    $m = MockClient::global([
        DeleteMessageRequest::class => MockResponse::make(),
    ]);

    $this->invision->system()->messages()->delete(1);

    $m->assertSent(DeleteMessageRequest::class);
});

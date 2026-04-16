<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Payload;

final readonly class CreateMessageReplyPayload extends Payload
{
    public function __construct(
        public int $messageId,
        public int $senderId,
        public string $body,
    ) {}

    public function toArray(): array
    {
        return [
            'body' => $this->body,
            'from' => $this->senderId,
        ];
    }
}

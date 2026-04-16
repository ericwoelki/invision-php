<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Payload;

final readonly class CreateMessagePayload extends Payload
{
    /**
     * @param  list<int>  $recipientIds
     */
    public function __construct(
        public int $senderId,
        public array $recipientIds,
        public string $title,
        public string $body,
    ) {}

    public function toArray(): array
    {
        return [
            'from' => $this->senderId,
            'to' => $this->recipientIds,
            'title' => $this->title,
            'body' => $this->body,
        ];
    }
}

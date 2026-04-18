<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Payloads;

use EricWoelki\Invision\Payload;

final readonly class DeleteRecordReactionPayload extends Payload
{
    public function __construct(
        public int $databaseId,
        public int $recordId,
        public int $memberId,
    ) {}

    public function toArray(): array
    {
        return [
            'author' => $this->memberId,
        ];
    }
}

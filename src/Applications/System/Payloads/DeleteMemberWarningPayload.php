<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Payload;

final readonly class DeleteMemberWarningPayload extends Payload
{
    public function __construct(
        public int $memberId,
        public int $warningId,
        public ?bool $deleteOnly = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'deleteOnly' => $this->deleteOnly,
        ]);
    }
}

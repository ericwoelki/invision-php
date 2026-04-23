<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Enums\ClubMemberStatus;
use EricWoelki\Invision\Payload;

final readonly class CreateClubMemberPayload extends Payload
{
    public function __construct(
        public int $clubId,
        public int $memberId,
        public ?ClubMemberStatus $status = null,
        public ?bool $waiveFee = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'id' => $this->memberId,
            'status' => $this->status?->value,
            'waiveFee' => $this->waiveFee !== null ? (int) $this->waiveFee : null,
        ]);
    }
}

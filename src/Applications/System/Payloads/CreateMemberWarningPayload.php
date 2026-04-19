<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Payload;

final readonly class CreateMemberWarningPayload extends Payload
{
    public function __construct(
        public int $memberId,
        public int $moderatorId,
        public ?int $reason = null,
        public ?int $points = null,
        public ?int $deductPoints = null,
        public ?string $memberNote = null,
        public ?string $moderatorNote = null,
        public ?bool $acknowledged = null,
        public string|int|null $modQueue = null,
        public string|int|null $restrictPosts = null,
        public string|int|null $suspend = null,
        public string|int|null $expire = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'moderator' => $this->moderatorId,
            'reason' => $this->reason,
            'points' => $this->points,
            'deductPoints' => $this->deductPoints,
            'memberNote' => $this->memberNote,
            'moderatorNote' => $this->moderatorNote,
            'acknowledged' => $this->acknowledged,
            'modQueue' => $this->modQueue,
            'restrictPosts' => $this->restrictPosts,
            'suspend' => $this->suspend,
            'expire' => $this->expire,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Enums\FollowType;
use EricWoelki\Invision\Payload;

final readonly class CreateMemberFollowPayload extends Payload
{
    public function __construct(
        public int $memberId,
        public string $application,
        public string $area,
        public int $itemId,
        public ?bool $anonymous = null,
        public ?bool $notify = null,
        public ?FollowType $type = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'followApp' => $this->application,
            'followArea' => $this->area,
            'followId' => $this->itemId,
            'followAnon' => $this->anonymous !== null ? (int) $this->anonymous : null,
            'followNotify' => $this->notify !== null ? (int) $this->notify : null,
            'followType' => $this->type?->value,
        ]);
    }
}

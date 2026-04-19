<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Payload;

final readonly class UpdateWarnReasonPayload extends Payload
{
    public function __construct(
        public int $warnReasonId,
        public string $name,
        public ?string $defaultNotes = null,
        public ?int $points = null,
        public ?bool $pointsOverride = null,
        public ?bool $pointsAutoRemove = null,
        public ?string $removePoints = null,
        public ?bool $removeOverride = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'name' => $this->name,
            'defaultNotes' => $this->defaultNotes,
            'points' => $this->points,
            'pointsOverride' => $this->pointsOverride,
            'pointsAutoRemove' => $this->pointsAutoRemove,
            'removePoints' => $this->removePoints,
            'removeOverride' => $this->removeOverride,
        ]);
    }
}

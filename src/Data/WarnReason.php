<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/**
 * @phpstan-type WarnReasonData array{id: int, name: string, defaultNotes: string, points: int,
 *  pointsOverride: bool, removeOverride: bool, removePoints: string|null, pointsAutoRemove: bool}
 */
final readonly class WarnReason
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $defaultNotes,
        public int $points,
        public bool $pointsOverride,
        public bool $removeOverride,
        public ?string $removePoints,
        public bool $pointsAutoRemove,
    ) {}

    /** @param WarnReasonData $data */
    public static function fromArray(array $data): WarnReason
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            defaultNotes: $data['defaultNotes'],
            points: $data['points'],
            pointsOverride: $data['pointsOverride'],
            removeOverride: $data['removeOverride'],
            removePoints: $data['removePoints'],
            pointsAutoRemove: $data['pointsAutoRemove'],
        );
    }
}

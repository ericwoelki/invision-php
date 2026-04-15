<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type RankData array{id: int, name: string, icon: string, points: int} */
final readonly class Rank
{
    public function __construct(
        public int $id,
        public string $name,
        public string $icon,
        public int $points,
    ) {}

    /** @param RankData $data */
    public static function fromArray(array $data): Rank
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            icon: $data['icon'],
            points: $data['points'],
        );
    }
}

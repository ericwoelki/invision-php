<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type RankData array{id: int, name: string, url: string, points: int} */
final readonly class Rank
{
    public function __construct(
        public int $id,
        public string $name,
        public string $url,
        public int $points,
    ) {}

    /** @param RankData $data */
    public static function fromArray(array $data): Rank
    {
        return new self(...$data);
    }
}

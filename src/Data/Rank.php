<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

final readonly class Rank
{
    public function __construct(
        public int $id,
        public string $name,
        public string $url,
        public int $points,
    ) {}
}

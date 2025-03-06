<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

final readonly class Group
{
    public function __construct(
        public int $id,
        public string $name,
        public string $formattedName,
    ) {}
}

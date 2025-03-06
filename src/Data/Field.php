<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

final readonly class Field
{
    public function __construct(
        public string $name,
        public ?string $value,
    ) {}
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

final readonly class FieldGroup
{
    /** @param list<Field> $fields */
    public function __construct(
        public string $name,
        public array $fields,
    ) {}
}

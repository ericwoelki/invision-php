<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type FieldData array{name: string, value: string|null} */
final readonly class Field
{
    public function __construct(
        public string $name,
        public ?string $value,
    ) {}

    /** @param FieldData $data */
    public static function fromArray(array $data): Field
    {
        return new self(...$data);
    }
}

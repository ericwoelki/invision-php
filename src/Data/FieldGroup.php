<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/**
 * @phpstan-import-type FieldData from Field
 *
 * @phpstan-type FieldGroupData array{name: string, fields: list<FieldData>}
 */
final readonly class FieldGroup
{
    /** @param list<Field> $fields */
    public function __construct(
        public string $name,
        public array $fields,
    ) {}

    /** @param FieldGroupData $data */
    public static function fromArray(array $data): FieldGroup
    {
        return new self(
            name: $data['name'],
            fields: array_map(Field::fromArray(...), $data['fields']),
        );
    }
}

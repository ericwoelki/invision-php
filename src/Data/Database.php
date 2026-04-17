<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/**
 * @phpstan-import-type DatabaseFieldData from DatabaseField
 * @phpstan-import-type PermissionsData from Permissions
 *
 * @phpstan-type DatabaseData array{id: int, name: string, useCategories: bool, fields: list<DatabaseFieldData>, url: string, permissions: PermissionsData}
 */
final readonly class Database
{
    /** @param list<DatabaseField> $fields */
    public function __construct(
        public int $id,
        public string $name,
        public bool $useCategories,
        public array $fields,
        public string $url,
        public Permissions $permissions,
    ) {}

    /** @param DatabaseData $data */
    public static function fromArray(array $data): Database
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            useCategories: $data['useCategories'],
            fields: array_map(DatabaseField::fromArray(...), $data['fields']),
            url: $data['url'],
            permissions: Permissions::fromArray($data['permissions']),
        );
    }
}

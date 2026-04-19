<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/**
 * @phpstan-import-type PermissionsData from Permissions
 *
 * @phpstan-type CalendarData array{id: int, name: string, url: string, class: string, parentId: int|null, permissions: PermissionsData}
 */
final readonly class Calendar
{
    public function __construct(
        public int $id,
        public string $name,
        public string $url,
        public string $class,
        public ?int $parentId,
        public Permissions $permissions,
    ) {}

    /** @param CalendarData $data */
    public static function fromArray(array $data): Calendar
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            url: $data['url'],
            class: $data['class'],
            parentId: $data['parentId'],
            permissions: Permissions::fromArray($data['permissions']),
        );
    }
}

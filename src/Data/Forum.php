<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use EricWoelki\Invision\Enums\ForumType;

/**
 * @phpstan-import-type PermissionsData from Permissions
 *
 * @phpstan-type ForumData array{id: int, name: string, path: string, type: string, topics: int, url: string, parentId: int|null, permissions: PermissionsData, club: int}
 */
final readonly class Forum
{
    public function __construct(
        public int $id,
        public string $name,
        public string $path,
        public ForumType $type,
        public int $topics,
        public string $url,
        public ?int $parentId,
        public ?Permissions $permissions,
        public int $club,
    ) {}

    /** @param ForumData $data */
    public static function fromArray(array $data): Forum
    {
        return new self(...array_merge($data, [
            'type' => ForumType::from($data['type']),
            'parentId' => $data['parentId'] ?? null,
            'permissions' => Permissions::fromArray($data['permissions']),
        ]));
    }
}

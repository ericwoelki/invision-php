<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/**
 * @phpstan-import-type MemberData from Member
 * @phpstan-import-type GroupData from Group
 * @phpstan-import-type BlogCategoryData from BlogCategory
 *
 * @phpstan-type BlogData array{id: int, name: string, description: string, owner: MemberData, groups: list<GroupData>,
 *  pinned: bool, entries: int, comments: int, url: string, category: BlogCategoryData|null}
 */
final readonly class Blog
{
    /** @param list<Group> $groups */
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public Member $owner,
        public array $groups,
        public bool $pinned,
        public int $entries,
        public int $comments,
        public string $url,
        public ?BlogCategory $category,
    ) {}

    /** @param BlogData $data */
    public static function fromArray(array $data): Blog
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            description: $data['description'],
            owner: Member::fromArray($data['owner']),
            groups: array_map(Group::fromArray(...), $data['groups']),
            pinned: $data['pinned'],
            entries: $data['entries'],
            comments: $data['comments'],
            url: $data['url'],
            category: $data['category'] !== null ? BlogCategory::fromArray($data['category']) : null,
        );
    }
}

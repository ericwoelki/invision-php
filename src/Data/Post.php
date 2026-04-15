<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type MemberData from Member
 *
 * @phpstan-type PostData array{id: int, item_id: int, author: MemberData, date: string, content: string, hidden: bool, url: string}
 */
final readonly class Post
{
    public function __construct(
        public int $id,
        public int $itemId,
        public Member $author,
        public CarbonImmutable $date,
        public string $content,
        public bool $hidden,
        public string $url,
    ) {}

    /** @param PostData $data */
    public static function fromArray(array $data): Post
    {
        return new self(
            id: $data['id'],
            itemId: $data['item_id'],
            author: Member::fromArray($data['author']),
            date: CarbonImmutable::parse($data['date']),
            content: $data['content'],
            hidden: $data['hidden'],
            url: $data['url'],
        );
    }
}

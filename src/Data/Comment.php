<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type MemberData from Member
 * @phpstan-import-type ReactionData from Reaction
 *
 * @phpstan-type CommentData array{id: int, item_id: int, author: MemberData, date: string, content: string, hidden: bool, url: string, reactions: array<int, list<ReactionData>>}
 */
final readonly class Comment
{
    /** @param array<int, list<Reaction>> $reactions */
    public function __construct(
        public int $id,
        public int $itemId,
        public Member $author,
        public CarbonImmutable $date,
        public string $content,
        public bool $hidden,
        public string $url,
        public array $reactions,
    ) {}

    /** @param CommentData $data */
    public static function fromArray(array $data): Comment
    {
        return new self(
            id: $data['id'],
            itemId: $data['item_id'],
            author: Member::fromArray($data['author']),
            date: CarbonImmutable::parse($data['date']),
            content: $data['content'],
            hidden: $data['hidden'],
            url: $data['url'],
            reactions: array_map(fn (array $reactions): array => array_map(Reaction::fromArray(...), $reactions), $data['reactions']),
        );
    }
}

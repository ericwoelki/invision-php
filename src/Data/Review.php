<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type MemberData from Member
 *
 * @phpstan-type ReviewData array{id: int, item_id: int, author: MemberData, date: string, rating: int, votesTotal: int|null, votesHelpful: int|null,
 *  content: string, hidden: bool, url: string, authorResponse: string|null}
 */
final readonly class Review
{
    public function __construct(
        public int $id,
        public int $itemId,
        public Member $author,
        public CarbonImmutable $date,
        public int $rating,
        public int $votesTotal,
        public int $votesHelpful,
        public string $content,
        public bool $hidden,
        public string $url,
        public ?string $authorResponse,
    ) {}

    /** @param ReviewData $data */
    public static function fromArray(array $data): Review
    {
        return new self(
            id: $data['id'],
            itemId: $data['item_id'],
            author: Member::fromArray($data['author']),
            date: CarbonImmutable::parse($data['date']),
            rating: $data['rating'],
            votesTotal: $data['votesTotal'] ?? 0,
            votesHelpful: $data['votesHelpful'] ?? 0,
            content: $data['content'],
            hidden: $data['hidden'],
            url: $data['url'],
            authorResponse: $data['authorResponse'],
        );
    }
}

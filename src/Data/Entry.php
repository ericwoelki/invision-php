<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type BlogData from Blog
 * @phpstan-import-type MemberData from Member
 * @phpstan-import-type PollData from Poll
 * @phpstan-import-type BlogCategoryData from BlogCategory
 *
 * @phpstan-type EntryData array{id: int, title: string, blog: BlogData, author: MemberData, draft: bool, date: string,
 *  entry: string, comments: int, views: int, prefix: string|null, tags: list<string>, locked: bool, hidden: bool, future: bool,
 *  pinned: bool, featured: bool, poll: PollData|null, url: string, rating: float, category: BlogCategoryData}
 */
final readonly class Entry
{
    /** @param list<string> $tags */
    public function __construct(
        public int $id,
        public string $title,
        public Blog $blog,
        public Member $author,
        public bool $draft,
        public CarbonImmutable $date,
        public string $entry,
        public int $comments,
        public int $views,
        public ?string $prefix,
        public array $tags,
        public bool $locked,
        public bool $hidden,
        public bool $future,
        public bool $pinned,
        public bool $featured,
        public ?Poll $poll,
        public string $url,
        public float $rating,
        public BlogCategory $category,
    ) {}

    /** @param EntryData $data */
    public static function fromArray(array $data): Entry
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            blog: Blog::fromArray($data['blog']),
            author: Member::fromArray($data['author']),
            draft: $data['draft'],
            date: CarbonImmutable::parse($data['date']),
            entry: $data['entry'],
            comments: $data['comments'],
            views: $data['views'],
            prefix: $data['prefix'],
            tags: $data['tags'],
            locked: $data['locked'],
            hidden: $data['hidden'],
            future: $data['future'],
            pinned: $data['pinned'],
            featured: $data['featured'],
            poll: $data['poll'] !== null ? Poll::fromArray($data['poll']) : null,
            url: $data['url'],
            rating: $data['rating'],
            category: BlogCategory::fromArray($data['category']),
        );
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type ForumData from Forum
 * @phpstan-import-type PostData from Post
 * @phpstan-import-type PollData from Poll
 *
 * @phpstan-type TopicData array{id: int, title: string, forum: ForumData, posts: int, views: int, prefix: string|null, tags: list<string>,
 *  firstPost: PostData, lastPost: PostData, bestAnswer: PostData|null, locked: bool, hidden: bool, pinned: bool, featured: bool, archived: bool,
 *  poll: PollData|null, url: string, rating: float, is_future_entry: int, publish_date: string|null}
 */
final readonly class Topic
{
    /** @param list<string> $tags */
    public function __construct(
        public int $id,
        public string $title,
        public Forum $forum,
        public int $posts,
        public int $views,
        public ?string $prefix,
        public array $tags,
        public Post $firstPost,
        public Post $lastPost,
        public ?Post $bestAnswer,
        public bool $locked,
        public bool $hidden,
        public bool $pinned,
        public bool $featured,
        public bool $archived,
        public ?Poll $poll,
        public string $url,
        public float $rating,
        public bool $isFutureEntry,
        public ?CarbonImmutable $publishDate,
    ) {}

    /** @param TopicData $data */
    public static function fromArray(array $data): Topic
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            forum: Forum::fromArray($data['forum']),
            posts: $data['posts'],
            views: $data['views'],
            prefix: $data['prefix'],
            tags: $data['tags'],
            firstPost: Post::fromArray($data['firstPost']),
            lastPost: Post::fromArray($data['lastPost']),
            bestAnswer: $data['bestAnswer'] !== null ? Post::fromArray($data['bestAnswer']) : null,
            locked: $data['locked'],
            hidden: $data['hidden'],
            pinned: $data['pinned'],
            featured: $data['featured'],
            archived: $data['archived'],
            poll: $data['poll'] !== null ? Poll::fromArray($data['poll']) : null,
            url: $data['url'],
            rating: $data['rating'],
            isFutureEntry: (bool) $data['is_future_entry'],
            publishDate: $data['publish_date'] !== null ? CarbonImmutable::parse($data['publish_date']) : null,
        );
    }
}

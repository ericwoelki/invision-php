<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type MemberData from Member
 * @phpstan-import-type DatabaseCategoryData from DatabaseCategory
 * @phpstan-import-type TopicData from Topic
 *
 * @phpstan-type RecordData array{id: int, title: string, category: DatabaseCategoryData, fields: array<string, string>, author: MemberData,
 *  date: string, description: string, comments: int, reviews: int, views: int, prefix: string|null, tags: list<string>,
 *  locked: bool, hidden: bool, pinned: bool, featured: bool, url: string, rating: float, image: string|null, topic: TopicData|null}
 */
final readonly class Record
{
    /**
     * @param  array<string, string>  $fields
     * @param  list<string>  $tags
     */
    public function __construct(
        public int $id,
        public string $title,
        public DatabaseCategory $category,
        public array $fields,
        public Member $author,
        public CarbonImmutable $date,
        public string $description,
        public int $comments,
        public int $reviews,
        public int $views,
        public ?string $prefix,
        public array $tags,
        public bool $locked,
        public bool $hidden,
        public bool $pinned,
        public bool $featured,
        public string $url,
        public float $rating,
        public ?string $image,
        public ?Topic $topic,
    ) {}

    /** @param RecordData $data */
    public static function fromArray(array $data): Record
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            category: DatabaseCategory::fromArray($data['category']),
            fields: $data['fields'],
            author: Member::fromArray($data['author']),
            date: CarbonImmutable::parse($data['date']),
            description: $data['description'],
            comments: $data['comments'],
            reviews: $data['reviews'],
            views: $data['views'],
            prefix: $data['prefix'],
            tags: $data['tags'],
            locked: $data['locked'],
            hidden: $data['hidden'],
            pinned: $data['pinned'],
            featured: $data['featured'],
            url: $data['url'],
            rating: $data['rating'],
            image: $data['image'],
            topic: $data['topic'] !== null ? Topic::fromArray($data['topic']) : null,
        );
    }
}

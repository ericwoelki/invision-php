<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-type ResultData array{title: string, content: string, class: string, objectId: int, itemClass: string, itemId: int,
 *  started: string, updated: string, itemUrl: string, objectUrl: string, reputation: int, comments: int|null, reviews: int|null,
 *  container: string, containerUrl: string, author: string, authorUrl: string|null, authorPhoto: string, authorPhotoThumbnail: string, tags: list<string>}
 */
final readonly class Result
{
    /** @param list<string> $tags */
    public function __construct(
        public string $title,
        public string $content,
        public string $class,
        public int $objectId,
        public string $itemClass,
        public int $itemId,
        public CarbonImmutable $started,
        public CarbonImmutable $updated,
        public string $itemUrl,
        public string $objectUrl,
        public int $reputation,
        public ?int $comments,
        public ?int $reviews,
        public string $container,
        public string $containerUrl,
        public string $author,
        public ?string $authorUrl,
        public string $authorPhoto,
        public string $authorPhotoThumbnail,
        public array $tags,
    ) {}

    /** @param ResultData $data */
    public static function fromArray(array $data): Result
    {
        return new self(
            title: $data['title'],
            content: $data['content'],
            class: $data['class'],
            objectId: $data['objectId'],
            itemClass: $data['itemClass'],
            itemId: $data['itemId'],
            started: CarbonImmutable::parse($data['started']),
            updated: CarbonImmutable::parse($data['updated']),
            itemUrl: $data['itemUrl'],
            objectUrl: $data['objectUrl'],
            reputation: $data['reputation'],
            comments: $data['comments'],
            reviews: $data['reviews'],
            container: $data['container'],
            containerUrl: $data['containerUrl'],
            author: $data['author'],
            authorUrl: $data['authorUrl'],
            authorPhoto: $data['authorPhoto'],
            authorPhotoThumbnail: $data['authorPhotoThumbnail'],
            tags: $data['tags']
        );
    }
}

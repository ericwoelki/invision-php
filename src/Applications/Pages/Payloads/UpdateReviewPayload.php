<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Payloads;

use EricWoelki\Invision\Enums\ContentVisibility;
use EricWoelki\Invision\Payload;

final readonly class UpdateReviewPayload extends Payload
{
    public function __construct(
        public int $databaseId,
        public int $reviewId,
        public ?int $authorId = null,
        public ?int $authorName = null,
        public ?string $content = null,
        public ?ContentVisibility $visibility = null,
        public ?int $rating = null,
        public ?bool $anonymous = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'author' => $this->authorId,
            'author_name' => $this->authorName,
            'content' => $this->content,
            'hidden' => $this->visibility?->value,
            'rating' => $this->rating,
            'anonymous' => $this->anonymous !== null ? (int) $this->anonymous : null,
        ]);
    }
}

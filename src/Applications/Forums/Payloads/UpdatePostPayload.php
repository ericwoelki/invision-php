<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Enums\ContentVisibility;
use EricWoelki\Invision\Payload;

final readonly class UpdatePostPayload extends Payload
{
    public function __construct(
        public int $postId,
        public ?int $authorId = null,
        public ?string $authorName = null,
        public ?string $content = null,
        public ?ContentVisibility $visibility = null,
        public ?bool $shouldBeAnonymous = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'author' => $this->authorId,
            'author_name' => $this->authorName,
            'post' => $this->content,
            'hidden' => $this->visibility?->value,
            'anonymous' => $this->shouldBeAnonymous !== null ? (int) $this->shouldBeAnonymous : null,
        ]);
    }
}

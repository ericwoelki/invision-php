<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Enums\ContentVisibility;
use EricWoelki\Invision\Payload;

final readonly class CreatePostPayload extends Payload
{
    public function __construct(
        public int $topicId,
        public int $authorId,
        public string $content,
        public ?string $authorName = null,
        public ?string $date = null,
        public ?string $ipAddress = null,
        public ?ContentVisibility $visibility = null,
        public ?bool $shouldBeAnonymous = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'topic' => $this->topicId,
            'author' => $this->authorId,
            'post' => $this->content,
            'author_name' => $this->authorName,
            'date' => $this->date,
            'ip_address' => $this->ipAddress,
            'hidden' => $this->visibility?->value,
            'anonymous' => $this->shouldBeAnonymous !== null ? (int) $this->shouldBeAnonymous : null,
        ]);
    }
}

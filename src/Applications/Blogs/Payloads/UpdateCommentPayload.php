<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Payloads;

use EricWoelki\Invision\Enums\ContentVisibility;
use EricWoelki\Invision\Payload;

final readonly class UpdateCommentPayload extends Payload
{
    public function __construct(
        public int $commentId,
        public ?int $authorId = null,
        public ?string $authorName = null,
        public ?string $content = null,
        public ?ContentVisibility $visibility = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'author' => $this->authorId,
            'author_name' => $this->authorName,
            'content' => $this->content,
            'hidden' => $this->visibility?->value,
        ]);
    }
}

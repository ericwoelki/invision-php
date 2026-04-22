<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Payloads;

use EricWoelki\Invision\Enums\ContentVisibility;
use EricWoelki\Invision\Payload;

final readonly class UpdateEntryPayload extends Payload
{
    /**
     * @param  list<string>|null  $tags
     * @param  list<array{title: string, answers: array<string, string>}>|null  $pollOptions
     */
    public function __construct(
        public int $entryId,
        public ?int $blogId = null,
        public ?int $authorId = null,
        public ?string $title = null,
        public ?string $content = null,
        public ?bool $draft = null,
        public ?string $prefix = null,
        public ?array $tags = null,
        public ?string $ipAddress = null,
        public ?bool $locked = null,
        public ?ContentVisibility $visibility = null,
        public ?bool $pinned = null,
        public ?bool $featured = null,
        public ?int $categoryId = null,
        public ?string $pollTitle = null,
        public ?bool $publicPoll = null,
        public ?bool $pollOnly = null,
        public ?array $pollOptions = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'blog' => $this->blogId,
            'author' => $this->authorId,
            'title' => $this->title,
            'entry' => $this->content,
            'draft' => $this->draft !== null ? (int) $this->draft : null,
            'prefix' => $this->prefix,
            'tags' => $this->tags !== null ? implode(',', $this->tags) : null,
            'ip_address' => $this->ipAddress,
            'locked' => $this->locked !== null ? (int) $this->locked : null,
            'hidden' => $this->visibility?->value,
            'pinned' => $this->pinned !== null ? (int) $this->pinned : null,
            'featured' => $this->featured !== null ? (int) $this->featured : null,
            'category' => $this->categoryId,
            'poll_title' => $this->pollTitle,
            'poll_public' => $this->publicPoll !== null ? (int) $this->publicPoll : null,
            'poll_only' => $this->publicPoll !== null ? (int) $this->publicPoll : null,
            'poll_options' => $this->pollOptions,
        ]);
    }
}

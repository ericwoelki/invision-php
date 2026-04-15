<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Payload;

final readonly class UpdateTopicPayload extends Payload
{
    /**
     * @param  list<string>|null  $tags
     * @param  list<array{title: string, answers: array<string, string>}>|null  $pollOptions
     */
    public function __construct(
        public int $topicId,
        public ?int $forumId = null,
        public ?int $authorId = null,
        public ?string $authorName = null,
        public ?string $title = null,
        public ?string $content = null,
        public ?string $prefix = null,
        public ?array $tags = null,
        public ?string $date = null,
        public ?string $ipAddress = null,
        public ?bool $locked = null,
        public ?string $openTime = null,
        public ?string $closeTime = null,
        public ?bool $hidden = null,
        public ?bool $pinned = null,
        public ?bool $featured = null,
        public ?string $pollTitle = null,
        public ?bool $publicPoll = null,
        public ?bool $pollOnly = null,
        public ?array $pollOptions = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'forum' => $this->forumId,
            'author' => $this->authorId,
            'author_name' => $this->authorName,
            'title' => $this->title,
            'post' => $this->content,
            'prefix' => $this->prefix,
            'tags' => $this->tags !== null ? implode(',', $this->tags) : null,
            'date' => $this->date,
            'ip_address' => $this->ipAddress,
            'locked' => $this->locked !== null ? (int) $this->locked : null,
            'open_time' => $this->openTime,
            'close_time' => $this->closeTime,
            'hidden' => $this->hidden !== null ? (int) $this->hidden : null,
            'pinned' => $this->pinned !== null ? (int) $this->pinned : null,
            'featured' => $this->featured !== null ? (int) $this->featured : null,
            'poll_title' => $this->pollTitle,
            'poll_public' => $this->publicPoll !== null ? (int) $this->publicPoll : null,
            'poll_only' => $this->pollOnly !== null ? (int) $this->pollOnly : null,
            'poll_options' => $this->pollOptions,
        ]);
    }
}

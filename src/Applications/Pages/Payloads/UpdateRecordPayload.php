<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Payloads;

use EricWoelki\Invision\Enums\ContentVisibility;
use EricWoelki\Invision\Payload;

final readonly class UpdateRecordPayload extends Payload
{
    /**
     * @param  array<int, string>|null  $fields
     * @param  list<string>|null  $tags
     * @param  array{name: string, contents: string}|null  $image
     */
    public function __construct(
        public int $databaseId,
        public int $recordId,
        public ?array $fields = null,
        public ?int $categoryId = null,
        public ?int $authorId = null,
        public ?string $prefix = null,
        public ?array $tags = null,
        public ?string $ipAddress = null,
        public ?bool $locked = null,
        public ?ContentVisibility $visibility = null,
        public ?bool $pinned = null,
        public ?bool $featured = null,
        public ?bool $anonymous = null,
        public ?array $image = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'fields' => $this->fields,
            'category' => $this->categoryId,
            'author' => $this->authorId,
            'prefix' => $this->prefix,
            'tags' => $this->tags !== null ? implode(',', $this->tags) : null,
            'ip_address' => $this->ipAddress,
            'locked' => $this->locked !== null ? (int) $this->locked : null,
            'hidden' => $this->visibility?->value,
            'pinned' => $this->pinned !== null ? (int) $this->pinned : null,
            'featured' => $this->featured !== null ? (int) $this->featured : null,
            'anonymous' => $this->anonymous !== null ? (int) $this->anonymous : null,
            'image' => $this->image,
        ]);
    }
}

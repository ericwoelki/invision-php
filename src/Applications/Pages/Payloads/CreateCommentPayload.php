<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Payloads;

use EricWoelki\Invision\Enums\ContentVisibility;
use EricWoelki\Invision\Payload;

final readonly class CreateCommentPayload extends Payload
{
    public function __construct(
        public int $databaseId,
        public int $recordId,
        public int $authorId,
        public string $content,
        public ?string $authorName = null,
        public ?string $date = null,
        public ?string $ipAddress = null,
        public ?ContentVisibility $visibility = null,
        public ?bool $anonymous = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'record' => $this->recordId,
            'author' => $this->authorId,
            'content' => $this->content,
            'author_name' => $this->authorName,
            'date' => $this->date,
            'ip_address' => $this->ipAddress,
            'hidden' => $this->visibility?->value,
            'anonymous' => $this->anonymous !== null ? (int) $this->anonymous : null,
        ]);
    }
}

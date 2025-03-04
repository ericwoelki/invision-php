<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Payloads\Topics;

use EricWoelki\Invision\Contracts\Arrayable;
use EricWoelki\Invision\Enums\SortDirection;

/** @implements Arrayable<string, mixed> */
final readonly class ListTopicsPayload implements Arrayable
{
    /**
     * @param  list<int>  $forums
     * @param  list<int>  $ids
     * @param  list<int>  $authors
     */
    public function __construct(
        public array $forums = [],
        public array $ids = [],
        public array $authors = [],
        public ?bool $hasBestAnswer = null,
        public ?bool $hasPoll = null,
        public ?bool $locked = null,
        public ?bool $hidden = null,
        public ?bool $pinned = null,
        public ?bool $featured = null,
        public ?bool $archived = null,
        public ?string $sortBy = null,
        public ?SortDirection $sortDir = null,
    ) {}

    public function toArray(): array
    {
        $payload = [];

        if ($this->forums !== []) {
            $payload['forums'] = implode(',', $this->forums);
        }

        if ($this->ids !== []) {
            $payload['ids'] = implode(',', $this->ids);
        }

        if ($this->authors !== []) {
            $payload['authors'] = implode(',', $this->authors);
        }

        if ($this->hasBestAnswer !== null) {
            $payload['hasBestAnswer'] = $this->hasBestAnswer ? 1 : 0;
        }

        if ($this->hasPoll !== null) {
            $payload['hasPoll'] = $this->hasPoll ? 1 : 0;
        }

        if ($this->locked !== null) {
            $payload['locked'] = $this->locked ? 1 : 0;
        }

        if ($this->hidden !== null) {
            $payload['hidden'] = $this->hidden ? 1 : 0;
        }

        if ($this->pinned !== null) {
            $payload['pinned'] = $this->pinned ? 1 : 0;
        }

        if ($this->featured !== null) {
            $payload['featured'] = $this->featured ? 1 : 0;
        }

        if ($this->archived !== null) {
            $payload['archived'] = $this->archived ? 1 : 0;
        }

        if ($this->sortBy !== null) {
            $payload['sortBy'] = $this->sortBy;
        }

        if ($this->sortDir instanceof SortDirection) {
            $payload['sortDir'] = $this->sortDir->value;
        }

        return $payload;
    }
}

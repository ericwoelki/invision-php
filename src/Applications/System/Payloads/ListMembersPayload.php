<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Enums\SortDirection;
use EricWoelki\Invision\Payload;

final readonly class ListMembersPayload extends Payload
{
    /**
     * @param  list<int>|null  $ids
     * @param  list<int>|int|null  $groups
     */
    public function __construct(
        public ?array $ids = null,
        public ?string $sortBy = null,
        public ?SortDirection $sortDir = null,
        public ?string $name = null,
        public ?string $email = null,
        public array|int|null $groups = null,
        public ?int $activityAfter = null,
        public ?int $activityBefore = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'ids' => $this->ids !== null ? implode(',', $this->ids) : null,
            'sortBy' => $this->sortBy,
            'sortDir' => $this->sortDir?->value,
            'name' => $this->name,
            'email' => $this->email,
            'group' => $this->groups,
            'activity_after' => $this->activityAfter,
            'activity_before' => $this->activityBefore,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

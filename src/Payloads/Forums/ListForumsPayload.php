<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Payloads\Forums;

use EricWoelki\Invision\Contracts\Arrayable;

/** @implements Arrayable<string, mixed> */
final readonly class ListForumsPayload implements Arrayable
{
    public function __construct(
        public bool $excludeClubForums = false,
        public int $page = 1,
        public int $perPage = 25,
    ) {}

    public function toArray(): array
    {
        $query = [];

        if ($this->excludeClubForums) {
            $query['clubs'] = 0;
        }

        $query['page'] = $this->page;
        $query['perPage'] = $this->perPage;

        return $query;
    }
}

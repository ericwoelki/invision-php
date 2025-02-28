<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use EricWoelki\Invision\Enums\ForumType;

final readonly class Forum
{
    public function __construct(
        public int $id,
        public string $name,
        public string $path,
        public ForumType $type,
        public int $topics,
        public string $url,
        public ?int $parentId,
    ) {}
}

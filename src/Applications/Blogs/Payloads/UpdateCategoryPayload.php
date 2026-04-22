<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Payloads;

use EricWoelki\Invision\Payload;

final readonly class UpdateCategoryPayload extends Payload
{
    public function __construct(
        public int $categoryId,
        public ?string $name = null,
        public ?int $parentId = null,
        public ?int $position = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'name' => $this->name,
            'parent' => $this->parentId,
            'position' => $this->position,
        ]);
    }
}

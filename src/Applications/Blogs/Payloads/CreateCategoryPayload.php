<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Payloads;

use EricWoelki\Invision\Payload;

final readonly class CreateCategoryPayload extends Payload
{
    public function __construct(
        public string $name,
        public ?int $parentId = null,
        public ?int $position = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'name' => $this->name,
            'parentId' => $this->parentId,
            'position' => $this->position,
        ]);
    }
}

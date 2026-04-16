<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type ReactionData array{id: int, title: string, value: int, icon: string} */
final readonly class Reaction
{
    public function __construct(
        public int $id,
        public string $title,
        public int $value,
        public string $icon,
    ) {}

    /** @param ReactionData $data */
    public static function fromArray(array $data): Reaction
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            value: $data['value'],
            icon: $data['icon'],
        );
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type GroupData array{id: int, name: string, formattedName: string} */
final readonly class Group
{
    public function __construct(
        public int $id,
        public string $name,
        public string $formattedName,
    ) {}

    /** @param GroupData $data */
    public static function fromArray(array $data): Group
    {
        return new self(...$data);
    }
}

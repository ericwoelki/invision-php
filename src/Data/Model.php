<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type ModelData array{id: int, name: string, url: string, class: string} */
final readonly class Model
{
    public function __construct(
        public int $id,
        public string $name,
        public string $url,
        public string $class,
    ) {}

    /** @param ModelData $data */
    public static function fromArray(array $data): Model
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            url: $data['url'],
            class: $data['class'],
        );
    }
}

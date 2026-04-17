<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type DatabaseFieldData array{id: int, title: string, description: string|null, type: string, default: string|null, required: bool, options: array<string, string>|null} */
final readonly class DatabaseField
{
    /** @param array<string, string>|null $options */
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
        public string $type,
        public ?string $default,
        public bool $required,
        public ?array $options,
    ) {}

    /** @param DatabaseFieldData $data */
    public static function fromArray(array $data): DatabaseField
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            description: $data['description'],
            type: $data['type'],
            default: $data['default'],
            required: $data['required'],
            options: $data['options'],
        );
    }
}

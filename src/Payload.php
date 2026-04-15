<?php

declare(strict_types=1);

namespace EricWoelki\Invision;

abstract readonly class Payload
{
    /** @return array<string, mixed> */
    abstract public function toArray(): array;

    /**
     * @param  array<string, mixed>  $array
     * @return array<string, mixed>
     */
    protected function filter(array $array): array
    {
        return array_filter($array, fn (mixed $value): bool => $value !== null);
    }
}

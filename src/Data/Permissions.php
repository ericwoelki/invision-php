<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type PermissionsData array{perm_id: int, perm_view: string, perm_2: string|null, perm_3: string|null, perm_4: string|null, perm_5: string|null, perm_6: string|null, perm_7: string|null} */
final readonly class Permissions
{
    /**
     * @param  list<int>|string  $perm_view
     * @param  list<int>|string  $perm_2
     * @param  list<int>|string  $perm_3
     * @param  list<int>|string  $perm_4
     * @param  list<int>|string  $perm_5
     * @param  list<int>|string  $perm_6
     * @param  list<int>|string  $perm_7
     */
    public function __construct(
        public int $perm_id,
        public array|string $perm_view,
        public array|string $perm_2,
        public array|string $perm_3,
        public array|string $perm_4,
        public array|string $perm_5,
        public array|string $perm_6,
        public array|string $perm_7,
    ) {}

    /** @param PermissionsData $data */
    public static function fromArray(array $data): Permissions
    {
        $evaluatePermissions = fn (?string $permissions): array|string => match ($permissions) {
            null => [],
            '*' => '*',
            default => array_map(fn (string $id): int => (int) $id, explode(',', $permissions)),
        };

        return new self(
            perm_id: $data['perm_id'],
            perm_view: $evaluatePermissions($data['perm_view']),
            perm_2: $evaluatePermissions($data['perm_2']),
            perm_3: $evaluatePermissions($data['perm_3']),
            perm_4: $evaluatePermissions($data['perm_4']),
            perm_5: $evaluatePermissions($data['perm_5']),
            perm_6: $evaluatePermissions($data['perm_6']),
            perm_7: $evaluatePermissions($data['perm_7']),
        );
    }
}

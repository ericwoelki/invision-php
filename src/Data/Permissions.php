<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type PermissionsData array{perm_id: int, perm_view: string, perm_2: string|null, perm_3: string|null, perm_4: string|null, perm_5: string|null, perm_6: string|null, perm_7: string|null} */
final readonly class Permissions
{
    /**
     * @param  list<int>  $perm_view
     * @param  list<int>  $perm_2
     * @param  list<int>  $perm_3
     * @param  list<int>  $perm_4
     * @param  list<int>  $perm_5
     * @param  list<int>  $perm_6
     * @param  list<int>  $perm_7
     */
    public function __construct(
        public int $perm_id,
        public array $perm_view,
        public array $perm_2,
        public array $perm_3,
        public array $perm_4,
        public array $perm_5,
        public array $perm_6,
        public array $perm_7,
    ) {}

    /** @param PermissionsData $data */
    public static function fromArray(array $data): Permissions
    {
        $groupPermissionIds = fn (string $permissions): array => array_map(fn (string $id): int => (int) $id, explode(',', $permissions));

        return new self(...array_merge($data, [
            'perm_view' => $groupPermissionIds($data['perm_view']),
            'perm_2' => $data['perm_2'] ? $groupPermissionIds($data['perm_2']) : [],
            'perm_3' => $data['perm_3'] ? $groupPermissionIds($data['perm_3']) : [],
            'perm_4' => $data['perm_4'] ? $groupPermissionIds($data['perm_4']) : [],
            'perm_5' => $data['perm_5'] ? $groupPermissionIds($data['perm_5']) : [],
            'perm_6' => $data['perm_6'] ? $groupPermissionIds($data['perm_6']) : [],
            'perm_7' => $data['perm_7'] ? $groupPermissionIds($data['perm_7']) : [],
        ]));
    }
}

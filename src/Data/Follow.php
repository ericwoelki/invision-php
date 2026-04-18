<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;
use EricWoelki\Invision\Enums\FollowType;

/**
 * @phpstan-type FollowData array{followKey: string, followApp: string, followArea: string, followId: int,
 *  followAnon: bool, followNotify: bool, followType: string|null, followSent: string|null, followName: string, followUrl: string}
 */
final readonly class Follow
{
    public function __construct(
        public string $key,
        public string $application,
        public string $area,
        public int $itemId,
        public bool $anonymous,
        public bool $notify,
        public ?FollowType $type,
        public ?CarbonImmutable $lastNotified,
        public string $description,
        public string $url,
    ) {}

    /** @param FollowData $data */
    public static function fromArray(array $data): Follow
    {
        return new self(
            key: $data['followKey'],
            application: $data['followApp'],
            area: $data['followArea'],
            itemId: $data['followId'],
            anonymous: $data['followAnon'],
            notify: $data['followNotify'],
            type: $data['followType'] !== null ? FollowType::from($data['followType']) : null,
            lastNotified: $data['followSent'] !== null ? CarbonImmutable::parse($data['followSent']) : null,
            description: $data['followName'],
            url: $data['followUrl'],
        );
    }
}

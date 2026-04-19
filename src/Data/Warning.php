<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type MemberData from Member
 * @phpstan-import-type WarnReasonData from WarnReason
 *
 * @phpstan-type WarningData array{id: int, member: MemberData, moderator: MemberData, points: int, reason: WarnReasonData,
 *  expiration: string|int, date: string, acknowledged: bool, memberNotes: string, moderatorNotes: string,
 *  modQueuePermanent: bool, modQueue: string|null, restrictPostsPermanent: bool, restrictPosts: string|null, suspendPermanent: bool, suspend: string|null}
 */
final readonly class Warning
{
    public function __construct(
        public int $id,
        public Member $member,
        public Member $moderator,
        public int $points,
        public WarnReason $reason,
        public ?CarbonImmutable $expiration,
        public CarbonImmutable $date,
        public bool $acknowledged,
        public string $memberNotes,
        public string $moderatorNotes,
        public bool $modQueuePermanent,
        public ?string $modQueue,
        public bool $restrictPostsPermanent,
        public ?string $restrictPosts,
        public bool $suspendPermanent,
        public ?string $suspend,
    ) {}

    /** @param WarningData $data */
    public static function fromArray(array $data): Warning
    {
        return new self(
            id: $data['id'],
            member: Member::fromArray($data['member']),
            moderator: Member::fromArray($data['moderator']),
            points: $data['points'],
            reason: WarnReason::fromArray($data['reason']),
            expiration: $data['expiration'] !== -1 ? CarbonImmutable::parse($data['expiration']) : null,
            date: CarbonImmutable::parse($data['date']),
            acknowledged: $data['acknowledged'],
            memberNotes: $data['memberNotes'],
            moderatorNotes: $data['moderatorNotes'],
            modQueuePermanent: $data['modQueuePermanent'],
            modQueue: $data['modQueue'],
            restrictPostsPermanent: $data['restrictPostsPermanent'],
            restrictPosts: $data['restrictPosts'],
            suspendPermanent: $data['suspendPermanent'],
            suspend: $data['suspend'],
        );
    }
}

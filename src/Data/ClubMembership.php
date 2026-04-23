<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/**
 * @phpstan-import-type MemberData from Member
 *
 * @phpstan-type ClubMembershipData array{owner: MemberData, leaders: list<MemberData>, moderators: list<MemberData>, members: list<MemberData>}
 */
final readonly class ClubMembership
{
    /**
     * @param  list<Member>  $leaders
     * @param  list<Member>  $moderators
     * @param  list<Member>  $members
     */
    public function __construct(
        public Member $owner,
        public array $leaders,
        public array $moderators,
        public array $members,
    ) {}

    /** @param ClubMembershipData $data */
    public static function fromArray(array $data): ClubMembership
    {
        return new self(
            owner: Member::fromArray($data['owner']),
            leaders: array_map(Member::fromArray(...), $data['leaders']),
            moderators: array_map(Member::fromArray(...), $data['moderators']),
            members: array_map(Member::fromArray(...), $data['members']),
        );
    }
}

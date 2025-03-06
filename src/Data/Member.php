<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type GroupData from Group
 * @phpstan-import-type FieldGroupData from FieldGroup
 * @phpstan-import-type RankData from Rank
 *
 * @phpstan-type MemberData array{id: int, name: string, title: string|null, timeZone: string, formattedName: string,
 *  primaryGroup: GroupData, secondaryGroups: list<GroupData>,
 *  email: string, joined: string, registrationIpAddress: string,  warningPoints: int, reputationPoints: int, photoUrl: string,
 *  photoUrlIsDefault: bool, coverPhotoUrl: string, profileUrl: string|null, validating: bool, posts: int,
 *  lastActivity: string|null, lastVisit: string|null, lastPost: string|null, profileViews: int, birthday: string|null,
 *  customFields: list<FieldGroupData>, rank: list<RankData>|null, achievements_points: int, allowAdminEmails: bool, completed: bool}
 */
final readonly class Member
{
    /**
     * @param  list<Group>  $secondaryGroups
     * @param  list<FieldGroup>  $customFields
     * @param  list<Rank>|null  $rank
     */
    public function __construct(
        public int $id,
        public string $name,
        public ?string $title,
        public string $timeZone,
        public string $formattedName,
        public Group $primaryGroup,
        public array $secondaryGroups,
        public string $email,
        public CarbonImmutable $joined,
        public string $registrationIpAddress,
        public int $warningPoints,
        public int $reputationPoints,
        public string $photoUrl,
        public bool $photoUrlIsDefault,
        public string $coverPhotoUrl,
        public ?string $profileUrl,
        public bool $validating,
        public int $posts,
        public ?CarbonImmutable $lastActivity,
        public ?CarbonImmutable $lastVisit,
        public ?CarbonImmutable $lastPost,
        public int $profileViews,
        public ?string $birthday,
        public array $customFields,
        public ?array $rank,
        public int $achievements_points,
        public bool $allowAdminEmails,
        public bool $completed,
    ) {}

    /** @param MemberData $data */
    public static function fromArray(array $data): Member
    {
        return new self(...array_merge($data, [
            'primaryGroup' => new Group(...$data['primaryGroup']),
            'secondaryGroups' => array_map(fn (array $group): Group => Group::fromArray($group), $data['secondaryGroups']),
            'joined' => CarbonImmutable::parse($data['joined']),
            'lastActivity' => $data['lastActivity'] ? CarbonImmutable::parse($data['lastActivity']) : null,
            'lastVisit' => $data['lastVisit'] ? CarbonImmutable::parse($data['lastVisit']) : null,
            'lastPost' => $data['lastPost'] ? CarbonImmutable::parse($data['lastPost']) : null,
            'customFields' => array_map(fn (array $fieldGroup): FieldGroup => FieldGroup::fromArray($fieldGroup), $data['customFields']),
            'rank' => $data['rank'] ? array_map(fn (array $rank): Rank => Rank::fromArray($rank), $data['rank']) : null,
        ]));
    }
}

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
 *  lastActivity: string|null, lastVisit: string|null, lastPost: string|null, profileViews: int|null, birthday: string|null,
 *  customFields: list<FieldGroupData>, rank: RankData|null, achievements_points: int|null, allowAdminEmails: bool, completed: bool}
 */
final readonly class Member
{
    /**
     * @param  list<Group>  $secondaryGroups
     * @param  list<FieldGroup>  $customFields
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
        public ?Rank $rank,
        public int $achievementsPoints,
        public bool $allowAdminEmails,
        public bool $registrationCompleted,
    ) {}

    /** @param MemberData $data */
    public static function fromArray(array $data): Member
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            title: $data['title'],
            timeZone: $data['timeZone'],
            formattedName: $data['formattedName'],
            primaryGroup: Group::fromArray($data['primaryGroup']),
            secondaryGroups: array_map(Group::fromArray(...), $data['secondaryGroups']),
            email: $data['email'],
            joined: CarbonImmutable::parse($data['joined']),
            registrationIpAddress: $data['registrationIpAddress'],
            warningPoints: $data['warningPoints'],
            reputationPoints: $data['reputationPoints'],
            photoUrl: $data['photoUrl'],
            photoUrlIsDefault: $data['photoUrlIsDefault'],
            coverPhotoUrl: $data['coverPhotoUrl'],
            profileUrl: $data['profileUrl'],
            validating: $data['validating'],
            posts: $data['posts'],
            lastActivity: $data['lastActivity'] ? CarbonImmutable::parse($data['lastActivity']) : null,
            lastVisit: $data['lastVisit'] ? CarbonImmutable::parse($data['lastVisit']) : null,
            lastPost: $data['lastPost'] ? CarbonImmutable::parse($data['lastPost']) : null,
            profileViews: $data['profileViews'] ?? 0,
            birthday: $data['birthday'],
            customFields: array_map(FieldGroup::fromArray(...), $data['customFields']),
            rank: $data['rank'] ? Rank::fromArray($data['rank']) : null,
            achievementsPoints: $data['achievements_points'] ?? 0,
            allowAdminEmails: $data['allowAdminEmails'],
            registrationCompleted: $data['completed'],
        );
    }
}

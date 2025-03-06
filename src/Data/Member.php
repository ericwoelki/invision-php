<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

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
        public string $timezone,
        public string $formattedName,
        public Group $primaryGroup,
        public array $secondaryGroups,
        public string $email,
        public string $joined,
        public string $registrationIpAddress,
        public int $warningPoints,
        public int $reputationPoints,
        public string $photoUrl,
        public bool $photoUrlIsDefault,
        public string $coverPhotoUrl,
        public ?string $profileUrl,
        public bool $validating,
        public int $posts,
        public ?string $lastActivity,
        public ?string $lastVisit,
        public ?string $lastPost,
        public int $profileViews,
        public ?string $birthday,
        public array $customFields,
        public ?array $rank,
        public int $achievements_points,
        public bool $allowAdminEmails,
        public bool $completed,
    ) {}
}

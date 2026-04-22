<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;
use EricWoelki\Invision\Enums\ClubType;

/**
 * @phpstan-import-type MemberData from Member
 * @phpstan-import-type GeolocationData from Geolocation
 * @phpstan-import-type FieldData from Field
 * @phpstan-import-type ModelData from Model
 *
 * @phpstan-type ClubData array{id: int, name: string, url: string, type: string, approved: bool, created: string,
 *  memberCount: int, owner: MemberData, photo: string|null, paid: bool, featured: bool, location: GeolocationData|null,
 *  about: string, lastActivity: string, contentCount: int, coverPhotoUrl: string|null, coverOffset: string, coverPhotoColor: string,
 *  members: list<MemberData>, leaders: list<MemberData>, moderators: list<MemberData>, fieldValues: list<FieldData>, nodes: list<ModelData>}
 */
final readonly class Club
{
    /**
     * @param  list<Member>  $members
     * @param  list<Member>  $leaders
     * @param  list<Member>  $moderators
     * @param  list<Field>  $fields
     * @param  list<Model>  $nodes
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $url,
        public ClubType $type,
        public bool $approved,
        public CarbonImmutable $created,
        public int $memberCount,
        public Member $owner,
        public ?string $photo,
        public bool $paid,
        public bool $featured,
        public ?Geolocation $location,
        public string $about,
        public CarbonImmutable $lastActivity,
        public int $contentCount,
        public ?string $coverPhotoUrl,
        public ?string $coverOffset,
        public string $coverPhotoColor,
        public array $members,
        public array $leaders,
        public array $moderators,
        public array $fields,
        public array $nodes,
    ) {}

    /** @param ClubData $data */
    public static function fromArray(array $data): Club
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            url: $data['url'],
            type: ClubType::from($data['type']),
            approved: $data['approved'],
            created: CarbonImmutable::parse($data['created']),
            memberCount: $data['memberCount'],
            owner: Member::fromArray($data['owner']),
            photo: $data['photo'],
            paid: $data['paid'],
            featured: $data['featured'],
            location: $data['location'] !== null ? Geolocation::fromArray($data['location']) : null,
            about: $data['about'],
            lastActivity: CarbonImmutable::parse($data['lastActivity']),
            contentCount: $data['contentCount'],
            coverPhotoUrl: $data['coverPhotoUrl'],
            coverOffset: $data['coverOffset'],
            coverPhotoColor: $data['coverPhotoColor'],
            members: array_map(Member::fromArray(...), $data['members']),
            leaders: array_map(Member::fromArray(...), $data['leaders']),
            moderators: array_map(Member::fromArray(...), $data['moderators']),
            fields: array_map(Field::fromArray(...), $data['fieldValues']),
            nodes: array_map(Model::fromArray(...), $data['nodes']),
        );
    }
}

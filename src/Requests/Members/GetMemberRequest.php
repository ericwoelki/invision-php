<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Requests\Members;

use Carbon\CarbonImmutable;
use EricWoelki\Invision\Data\Field;
use EricWoelki\Invision\Data\FieldGroup;
use EricWoelki\Invision\Data\Group;
use EricWoelki\Invision\Data\Member;
use EricWoelki\Invision\Data\Rank;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

final class GetMemberRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly int $id) {}

    public function resolveEndpoint(): string
    {
        return 'core/members/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Member
    {
        /** @var array{id: int, name: string, title: string|null, timeZone: string, formattedName: string,
         * primaryGroup: array{id: int, name: string, formattedName: string}, secondaryGroups: list<array{id: int, name: string, formattedName: string}>,
         * email: string, joined: string, registrationIpAddress: string,  warningPoints: int, reputationPoints: int, photoUrl: string,
         * photoUrlIsDefault: bool, coverPhotoUrl: string, profileUrl: string|null, validating: bool, posts: int,
         * lastActivity: string|null, lastVisit: string|null, lastPost: string|null, profileViews: int, birthday: string|null,
         * customFields: list<array{name: string, fields: list<array{name: string, value: string|null}>}>,
         * rank: list<array{id: int, name: string, url: string, points: int}>|null,
         * achievements_points: int, allowAdminEmails: bool, completed: bool} $data */
        $data = $response->json();

        return new Member(
            id: $data['id'],
            name: $data['name'],
            title: $data['title'],
            timezone: $data['timeZone'],
            formattedName: $data['formattedName'],
            primaryGroup: new Group(
                id: $data['primaryGroup']['id'],
                name: $data['primaryGroup']['name'],
                formattedName: $data['primaryGroup']['formattedName'],
            ),
            secondaryGroups: array_map(fn (array $group): Group => new Group(
                id: $group['id'],
                name: $group['name'],
                formattedName: $group['formattedName'],
            ), $data['secondaryGroups']),
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
            profileViews: $data['profileViews'],
            birthday: $data['birthday'],
            customFields: array_map(fn (array $fieldGroup): FieldGroup => new FieldGroup(
                name: $fieldGroup['name'],
                fields: array_map(fn (array $field): Field => new Field(
                    name: $field['name'],
                    value: $field['value'],
                ), $fieldGroup['fields']),
            ), $data['customFields']),
            rank: $data['rank'] !== null ? array_map(fn (array $rank): Rank => new Rank(
                id: $rank['id'],
                name: $rank['name'],
                url: $rank['url'],
                points: $rank['points'],
            ), $data['rank']) : null,
            achievements_points: $data['achievements_points'],
            allowAdminEmails: $data['allowAdminEmails'],
            completed: $data['completed'],
        );
    }
}

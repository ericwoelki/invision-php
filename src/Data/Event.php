<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type CalendarData from Calendar
 * @phpstan-import-type GeolocationData from Geolocation
 * @phpstan-import-type VenueData from Venue
 * @phpstan-import-type MemberData from Member
 *
 * @phpstan-type EventData array{id: int, title: string, calendar: CalendarData, start: string, end: string, recurrence: string|null,
 *  rsvp: bool, rsvpLimit: int|null, location: GeolocationData|null, venue: VenueData|null, author: MemberData, postedDate: string, description: string,
 *  comments: int, reviews: int, views: int, prefix: string, tags: list<string>, locked: bool, hidden: bool, featured: bool, url: string}
 */
final readonly class Event
{
    /**
     * @param  list<string>  $tags
     */
    public function __construct(
        public int $id,
        public string $title,
        public Calendar $calendar,
        public CarbonImmutable $start,
        public CarbonImmutable $end,
        public ?string $recurrence,
        public bool $rsvp,
        public ?int $rsvpLimit,
        public ?Geolocation $location,
        public ?Venue $venue,
        public Member $author,
        public CarbonImmutable $postedDate,
        public string $description,
        public int $comments,
        public int $reviews,
        public int $views,
        public ?string $prefix,
        public array $tags,
        public bool $locked,
        public bool $hidden,
        public bool $featured,
        public string $url,
    ) {}

    /** @param EventData $data */
    public static function fromArray(array $data): Event
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            calendar: Calendar::fromArray($data['calendar']),
            start: CarbonImmutable::parse($data['start']),
            end: CarbonImmutable::parse($data['end']),
            recurrence: $data['recurrence'],
            rsvp: $data['rsvp'],
            rsvpLimit: $data['rsvpLimit'],
            location: $data['location'] !== null ? Geolocation::fromArray($data['location']) : null,
            venue: $data['venue'] !== null ? Venue::fromArray($data['venue']) : null,
            author: Member::fromArray($data['author']),
            postedDate: CarbonImmutable::parse($data['postedDate']),
            description: $data['description'],
            comments: $data['comments'],
            reviews: $data['reviews'],
            views: $data['views'],
            prefix: $data['prefix'],
            tags: $data['tags'],
            locked: $data['locked'],
            hidden: $data['hidden'],
            featured: $data['featured'],
            url: $data['url'],
        );
    }
}

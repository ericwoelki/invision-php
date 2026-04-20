<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/**
 * @phpstan-import-type MemberData from Member
 *
 * @phpstan-type EventRSVPsData array{attending: list<MemberData>, notAttending: list<MemberData>, maybeAttending: list<MemberData>}
 */
final readonly class EventRSVPs
{
    /**
     * @param  list<Member>  $attending
     * @param  list<Member>  $notAttending
     * @param  list<Member>  $maybeAttending
     */
    public function __construct(
        public array $attending,
        public array $notAttending,
        public array $maybeAttending,
    ) {}

    /** @param EventRSVPsData $data */
    public static function fromArray(array $data): EventRSVPs
    {
        return new self(
            attending: array_map(Member::fromArray(...), $data['attending']),
            notAttending: array_map(Member::fromArray(...), $data['notAttending']),
            maybeAttending: array_map(Member::fromArray(...), $data['maybeAttending']),
        );
    }
}

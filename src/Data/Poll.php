<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

use Carbon\CarbonImmutable;

/**
 * @phpstan-import-type QuestionData from Question
 *
 * @phpstan-type PollData array{id: int, title: string, startDate: string, closed: bool, closedDate: string|null, public: bool, votes: int, questions: list<QuestionData>}
 */
final readonly class Poll
{
    /** @param list<Question> $questions */
    public function __construct(
        public int $id,
        public string $title,
        public CarbonImmutable $startDate,
        public bool $closed,
        public ?CarbonImmutable $closedDate,
        public bool $public,
        public int $votes,
        public array $questions,
    ) {}

    /** @param PollData $data */
    public static function fromArray(array $data): Poll
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            startDate: CarbonImmutable::parse($data['startDate']),
            closed: $data['closed'],
            closedDate: $data['closedDate'] !== null ? CarbonImmutable::parse($data['closedDate']) : null,
            public: $data['public'],
            votes: $data['votes'],
            questions: array_map(Question::fromArray(...), $data['questions']),
        );
    }
}

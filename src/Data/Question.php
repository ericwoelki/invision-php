<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Data;

/** @phpstan-type QuestionData array{question: string, options: array<string, int>} */
final readonly class Question
{
    /** @param array<string, int> $options */
    public function __construct(
        public string $question,
        public array $options,
    ) {}

    /** @param QuestionData $data */
    public static function fromArray(array $data): Question
    {
        return new self(
            question: $data['question'],
            options: $data['options'],
        );
    }
}

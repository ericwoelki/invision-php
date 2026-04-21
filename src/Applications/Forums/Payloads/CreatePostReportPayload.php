<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Payload;

final readonly class CreatePostReportPayload extends Payload
{
    public function __construct(
        public int $postId,
        public int $reporterId,
        public ?int $typeId = null,
        public ?string $message = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'author' => $this->reporterId,
            'report_type' => $this->typeId,
            'message' => $this->message,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Events\Payloads;

use EricWoelki\Invision\Payload;

final readonly class DeleteCommentReactionPayload extends Payload
{
    public function __construct(
        public int $commentId,
        public int $memberId,
    ) {}

    public function toArray(): array
    {
        return [
            'author' => $this->memberId,
        ];
    }
}

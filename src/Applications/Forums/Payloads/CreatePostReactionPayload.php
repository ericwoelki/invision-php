<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Payload;

final readonly class CreatePostReactionPayload extends Payload
{
    public function __construct(
        public int $postId,
        public int $memberId,
        public int $reactionId,
    ) {}

    public function toArray(): array
    {
        return [
            'author' => $this->memberId,
            'id' => $this->reactionId,
        ];
    }
}

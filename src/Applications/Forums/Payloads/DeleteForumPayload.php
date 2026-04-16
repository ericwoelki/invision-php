<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Payload;
use InvalidArgumentException;

final readonly class DeleteForumPayload extends Payload
{
    private const int DELETE_CHILDREN = -1;

    public function __construct(
        public int $forumId,
        public ?bool $deleteChildren = null,
        public ?int $moveChildrenTo = null,
    ) {
        if ($this->deleteChildren === null && $this->moveChildrenTo === null) {
            throw new InvalidArgumentException('deleteChildren or moveChildrenTo must be set');
        }
    }

    public function toArray(): array
    {
        return [
            'deleteChildrenOrMove' => $this->deleteChildren !== null
                ? self::DELETE_CHILDREN
                : $this->moveChildrenTo,
        ];
    }
}

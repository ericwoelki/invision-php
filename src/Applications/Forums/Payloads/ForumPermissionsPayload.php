<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Payload;

final readonly class ForumPermissionsPayload extends Payload
{
    /**
     * @param  string|list<int>  $view
     * @param  string|list<int>  $read
     * @param  string|list<int>  $add
     * @param  string|list<int>  $reply
     * @param  string|list<int>  $attachments
     */
    public function __construct(
        public string|array $view,
        public string|array $read,
        public string|array $add,
        public string|array $reply,
        public string|array $attachments,
    ) {}

    public function toArray(): array
    {
        return [
            'view' => $this->view,
            'read' => $this->read,
            'add' => $this->add,
            'reply' => $this->reply,
            'attachments' => $this->attachments,
        ];
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Payload;

final readonly class UpdateMemberPayload extends Payload
{
    /**
     * @param  list<int>|int|null  $group
     * @param  list<int>|null  $secondaryGroups
     * @param  array<int, mixed>|null  $customFields
     */
    public function __construct(
        public int $memberId,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $password = null,
        public array|int|null $group = null,
        public ?string $registrationIpAddress = null,
        public ?array $secondaryGroups = null,
        public ?array $customFields = null,
        public ?bool $markValidated = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'group' => $this->group,
            'registrationIpAddress' => $this->registrationIpAddress,
            'secondaryGroups' => $this->secondaryGroups,
            'customFields' => $this->customFields,
            'validated' => $this->markValidated !== null ? (int) $this->markValidated : null,
        ]);
    }
}

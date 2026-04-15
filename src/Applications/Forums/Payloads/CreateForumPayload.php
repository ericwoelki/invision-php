<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Payloads;

use EricWoelki\Invision\Enums\ForumType;
use EricWoelki\Invision\Payload;

final readonly class CreateForumPayload extends Payload
{
    private const int NO_PARENT = -1;

    public function __construct(
        public string $title,
        public ?string $description = null,
        public ?ForumType $type = null,
        public ?int $parent = null,
        public ?string $password = null,
        public ?int $theme = null,
        public ?int $sitemapPriority = null,
        public ?int $minimumContent = null,
        public ?bool $canSeeOthers = null,
        public ?ForumPermissionsPayload $permissions = null,
        public ?string $redirectUrl = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type?->creationIdentifier(),
            'parent' => $this->parent === null || $this->parent === 0 ? self::NO_PARENT : $this->parent,
            'password' => $this->password,
            'theme' => $this->theme,
            'sitemap_priority' => $this->sitemapPriority,
            'min_content' => $this->minimumContent,
            'can_see_others' => $this->canSeeOthers,
            'permissions' => $this->permissions,
            'redirect_url' => $this->redirectUrl,
        ]);
    }
}

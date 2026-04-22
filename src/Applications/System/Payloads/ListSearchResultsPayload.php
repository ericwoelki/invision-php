<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Payloads;

use EricWoelki\Invision\Payload;

final readonly class ListSearchResultsPayload extends Payload
{
    /**
     * @param  list<string>|null  $tags
     * @param  list<int>|null  $nodeIds
     * @param  list<int>|null  $clubIds
     */
    public function __construct(
        public ?string $query = null,
        public ?array $tags = null,
        public ?string $type = null,
        public ?int $itemId = null,
        public ?array $nodeIds = null,
        public ?int $minimumComments = null,
        public ?int $minimumReplies = null,
        public ?int $minimumReviews = null,
        public ?int $minimumViews = null,
        public ?string $authorName = null,
        public ?array $clubIds = null,
        public ?string $startBefore = null,
        public ?string $startAfter = null,
        public ?string $updatedBefore = null,
        public ?string $updatedAfter = null,
        public ?string $sortby = null,
        public ?string $eitherTermsOrTags = null,
        public ?string $searchAndOr = null,
        public ?string $searchIn = null,
        public ?int $searchAsId = null,
        public ?bool $doNotTrack = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {}

    public function toArray(): array
    {
        return $this->filter([
            'q' => $this->query,
            'tags' => $this->tags !== null ? implode(',', $this->tags) : null,
            'type' => $this->type,
            'item' => $this->itemId,
            'nodes' => $this->nodeIds !== null ? implode(',', $this->nodeIds) : null,
            'search_min_comments' => $this->minimumComments,
            'search_min_replies' => $this->minimumReplies,
            'search_min_reviews' => $this->minimumReviews,
            'search_min_views' => $this->minimumViews,
            'author' => $this->authorName,
            'club' => $this->clubIds !== null ? implode(',', $this->clubIds) : null,
            'start_before' => $this->startBefore,
            'start_after' => $this->startAfter,
            'updated_before' => $this->updatedBefore,
            'updated_after' => $this->updatedAfter,
            'sortby' => $this->sortby,
            'eitherTermsOrTags' => $this->eitherTermsOrTags,
            'search_and_or' => $this->searchAndOr,
            'search_in' => $this->searchIn,
            'search_as' => $this->searchAsId,
            'doNotTrack' => $this->doNotTrack,
            'page' => $this->page,
            'perPage' => $this->perPage,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Data\Entry;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type EntryData from Entry */
final class GetEntryRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly int $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/entries/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Entry
    {
        /** @var EntryData $data */
        $data = $response->json();

        return Entry::fromArray($data);
    }
}

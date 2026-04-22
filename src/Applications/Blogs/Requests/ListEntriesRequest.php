<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListEntriesPayload;
use EricWoelki\Invision\Data\Entry;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type EntryData from Entry */
final class ListEntriesRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListEntriesPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/entries';
    }

    /** @return array<int, Entry> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, EntryData> $data */
        $data = $response->json('results');

        return array_map(Entry::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

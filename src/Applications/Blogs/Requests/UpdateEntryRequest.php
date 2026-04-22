<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Applications\Blogs\Payloads\UpdateEntryPayload;
use EricWoelki\Invision\Data\Entry;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type EntryData from Entry */
final class UpdateEntryRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly UpdateEntryPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/entries/'.$this->payload->entryId;
    }

    public function createDtoFromResponse(Response $response): Entry
    {
        /** @var EntryData $data */
        $data = $response->json();

        return Entry::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

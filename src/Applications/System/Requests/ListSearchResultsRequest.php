<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\ListSearchResultsPayload;
use EricWoelki\Invision\Data\Result;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ResultData from Result */
final class ListSearchResultsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListSearchResultsPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/search';
    }

    /** @return array<int, Result> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, ResultData> $data */
        $data = $response->json('results');

        return array_map(Result::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\ListForumsPayload;
use EricWoelki\Invision\Data\Forum;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type ForumData from Forum */
final class ListForumsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly ?ListForumsPayload $payload = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'forums/forums';
    }

    /** @return array<int, Forum> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, ForumData> $data */
        $data = $response->json('results');

        return array_map(Forum::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

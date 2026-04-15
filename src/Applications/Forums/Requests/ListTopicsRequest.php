<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\ListTopicsPayload;
use EricWoelki\Invision\Data\Topic;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type TopicData from Topic */
final class ListTopicsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly ?ListTopicsPayload $payload = null) {}

    public function resolveEndpoint(): string
    {
        return 'forums/topics';
    }

    /** @return array<int, Topic> */
    public function createDtoFromResponse(Response $response): array
    {
        /** @var array<int, TopicData> $data */
        $data = $response->json('results');

        return array_map(Topic::fromArray(...), $data);
    }

    protected function defaultQuery(): array
    {
        return $this->payload?->toArray() ?? [];
    }
}

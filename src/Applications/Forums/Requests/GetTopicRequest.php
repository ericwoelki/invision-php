<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Data\Topic;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type TopicData from Topic */
final class GetTopicRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly int $id) {}

    public function resolveEndpoint(): string
    {
        return 'forums/topics/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Topic
    {
        /** @var TopicData $data */
        $data = $response->json();

        return Topic::fromArray($data);
    }
}

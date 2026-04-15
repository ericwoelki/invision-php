<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\UpdateTopicPayload;
use EricWoelki\Invision\Data\Topic;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type TopicData from Topic */
final class UpdateTopicRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly UpdateTopicPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'forums/topics/'.$this->payload->topicId;
    }

    public function createDtoFromResponse(Response $response): Topic
    {
        /** @var TopicData $data */
        $data = $response->json();

        return Topic::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

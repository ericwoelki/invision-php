<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums\Requests;

use EricWoelki\Invision\Applications\Forums\Payloads\UpdateForumPayload;
use EricWoelki\Invision\Data\Forum;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type ForumData from Forum */
final class UpdateForumRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly UpdateForumPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'forums/forums/'.$this->payload->forumId;
    }

    public function createDtoFromResponse(Response $response): Forum
    {
        /** @var ForumData $data */
        $data = $response->json();

        return Forum::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

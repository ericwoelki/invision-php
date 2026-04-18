<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberFollowPayload;
use EricWoelki\Invision\Data\Follow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type FollowData from Follow */
final class CreateMemberFollowRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateMemberFollowPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return "core/members/{$this->payload->memberId}/follows";
    }

    public function createDtoFromResponse(Response $response): Follow
    {
        /** @var FollowData $data */
        $data = $response->json();

        return Follow::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

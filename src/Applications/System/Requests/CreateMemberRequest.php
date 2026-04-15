<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\CreateMemberPayload;
use EricWoelki\Invision\Data\Member;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type MemberData from Member */
final class CreateMemberRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly CreateMemberPayload $payload) {}

    public function resolveEndpoint(): string
    {
        return 'core/members';
    }

    public function createDtoFromResponse(Response $response): Member
    {
        /** @var MemberData $data */
        $data = $response->json();

        return Member::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

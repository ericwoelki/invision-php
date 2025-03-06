<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Requests\Members;

use EricWoelki\Invision\Data\Member;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/** @phpstan-import-type MemberData from Member */
final class GetMemberRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(private readonly int $id) {}

    public function resolveEndpoint(): string
    {
        return 'core/members/'.$this->id;
    }

    public function createDtoFromResponse(Response $response): Member
    {
        /** @var MemberData $data */
        $data = $response->json();

        return Member::fromArray($data);
    }
}

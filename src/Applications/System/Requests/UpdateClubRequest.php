<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System\Requests;

use EricWoelki\Invision\Applications\System\Payloads\UpdateClubPayload;
use EricWoelki\Invision\Data\Club;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type ClubData from Club */
final class UpdateClubRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly UpdateClubPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'core/clubs/'.$this->payload->clubId;
    }

    public function createDtoFromResponse(Response $response): Club
    {
        /** @var ClubData $data */
        $data = $response->json();

        return Club::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

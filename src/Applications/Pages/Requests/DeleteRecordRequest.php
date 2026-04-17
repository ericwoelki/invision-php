<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Pages\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class DeleteRecordRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private readonly int $databaseId,
        private readonly int $recordId,
    ) {}

    public function resolveEndpoint(): string
    {
        return "cms/records/{$this->databaseId}/{$this->recordId}";
    }
}

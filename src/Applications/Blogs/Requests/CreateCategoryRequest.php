<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs\Requests;

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateCategoryPayload;
use EricWoelki\Invision\Data\BlogCategory;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/** @phpstan-import-type BlogCategoryData from BlogCategory */
final class CreateCategoryRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateCategoryPayload $payload,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'blog/categories';
    }

    public function createDtoFromResponse(Response $response): BlogCategory
    {
        /** @var BlogCategoryData $data */
        $data = $response->json();

        return BlogCategory::fromArray($data);
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->payload->toArray();
    }
}

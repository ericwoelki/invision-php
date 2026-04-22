<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Payloads\ListSearchResultsPayload;
use EricWoelki\Invision\Applications\System\Requests\ListSearchResultsRequest;
use EricWoelki\Invision\Applications\System\Requests\ListSearchTypesRequest;
use EricWoelki\Invision\Data\Result;
use Saloon\Http\BaseResource;

final class SearchResource extends BaseResource
{
    /** @return list<string> */
    public function types(): array
    {
        $request = new ListSearchTypesRequest;

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    /** @return array<int, Result> */
    public function results(?ListSearchResultsPayload $payload = null): array
    {
        $request = new ListSearchResultsRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

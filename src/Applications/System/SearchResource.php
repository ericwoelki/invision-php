<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\System;

use EricWoelki\Invision\Applications\System\Requests\ListSearchTypesRequest;
use Saloon\Http\BaseResource;

final class SearchResource extends BaseResource
{
    /** @return list<string> */
    public function types(): array
    {
        $request = new ListSearchTypesRequest;

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

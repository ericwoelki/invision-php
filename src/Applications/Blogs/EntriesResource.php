<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs;

use EricWoelki\Invision\Applications\Blogs\Payloads\ListEntriesPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\ListEntriesRequest;
use EricWoelki\Invision\Data\Entry;
use Saloon\Http\BaseResource;

final class EntriesResource extends BaseResource
{
    /** @return array<int, Entry> */
    public function list(?ListEntriesPayload $payload = null): array
    {
        $request = new ListEntriesRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

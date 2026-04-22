<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Blogs;

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateEntryPayload;
use EricWoelki\Invision\Applications\Blogs\Payloads\ListEntriesPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateEntryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetEntryRequest;
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

    public function get(int $id): Entry
    {
        $request = new GetEntryRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }

    public function create(CreateEntryPayload $payload): Entry
    {
        $request = new CreateEntryRequest($payload);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

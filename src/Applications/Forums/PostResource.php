<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Applications\Forums;

use EricWoelki\Invision\Applications\Forums\Requests\GetPostRequest;
use EricWoelki\Invision\Data\Post;
use Saloon\Http\BaseResource;

final class PostResource extends BaseResource
{
    public function get(int $id): Post
    {
        $request = new GetPostRequest($id);

        return $request->createDtoFromResponse($this->connector->send($request));
    }
}

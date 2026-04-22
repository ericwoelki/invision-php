<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Requests\ListCategoriesRequest;
use EricWoelki\Invision\Data\BlogCategory;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists categories', function (): void {
    MockClient::global([
        ListCategoriesRequest::class => new InvisionFixture('blogs/categories/list'),
    ]);

    $categories = $this->invision->blogs()->categories()->list();

    expect($categories)
        ->toBeArray()
        ->toContainOnlyInstancesOf(BlogCategory::class);
});

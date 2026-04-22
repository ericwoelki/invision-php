<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Requests\GetCategoryRequest;
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

it('gets a category', function (): void {
    MockClient::global([
        GetCategoryRequest::class => new InvisionFixture('blogs/categories/get'),
    ]);

    $category = $this->invision->blogs()->categories()->get(1);

    expect($category)->toBeInstanceOf(BlogCategory::class);
});

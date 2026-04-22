<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Requests\GetEntryCategoryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListEntryCategoriesRequest;
use EricWoelki\Invision\Data\BlogCategory;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists entry categories', function (): void {
    MockClient::global([
        ListEntryCategoriesRequest::class => new InvisionFixture('blogs/entry-categories/list'),
    ]);

    $categories = $this->invision->blogs()->entryCategories()->list();

    expect($categories)
        ->toBeArray()
        ->toContainOnlyInstancesOf(BlogCategory::class);
});

it('gets a entry category', function (): void {
    MockClient::global([
        GetEntryCategoryRequest::class => new InvisionFixture('blogs/entry-categories/get'),
    ]);

    $category = $this->invision->blogs()->entryCategories()->get(1);

    expect($category)->toBeInstanceOf(BlogCategory::class);
});

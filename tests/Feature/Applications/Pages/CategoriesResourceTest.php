<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Pages\Requests\GetCategoryRequest;
use EricWoelki\Invision\Applications\Pages\Requests\ListCategoriesRequest;
use EricWoelki\Invision\Data\DatabaseCategory;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists categories', function (): void {
    MockClient::global([
        ListCategoriesRequest::class => new InvisionFixture('pages/categories/list'),
    ]);

    $categories = $this->invision->pages()->categories()->list(1);

    expect($categories)
        ->toBeArray()
        ->toContainOnlyInstancesOf(DatabaseCategory::class);
});

it('gets a category', function (): void {
    MockClient::global([
        GetCategoryRequest::class => new InvisionFixture('pages/categories/get'),
    ]);

    $category = $this->invision->pages()->categories()->get(databaseId: 1, categoryId: 1);

    expect($category)->toBeInstanceOf(DatabaseCategory::class);
});

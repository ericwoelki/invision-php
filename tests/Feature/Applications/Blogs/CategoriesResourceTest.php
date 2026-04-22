<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Payloads\CreateCategoryPayload;
use EricWoelki\Invision\Applications\Blogs\Payloads\UpdateCategoryPayload;
use EricWoelki\Invision\Applications\Blogs\Requests\CreateCategoryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetCategoryRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListCategoriesRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\UpdateCategoryRequest;
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

it('creates a category', function (): void {
    MockClient::global([
        CreateCategoryRequest::class => new InvisionFixture('blogs/categories/create'),
    ]);

    $category = $this->invision->blogs()->categories()->create(new CreateCategoryPayload(
        name: '::name::',
    ));

    expect($category)
        ->toBeInstanceOf(BlogCategory::class)
        ->and($category->name)->toBe('::name::');
});

it('updates a category', function (): void {
    MockClient::global([
        UpdateCategoryRequest::class => new InvisionFixture('blogs/categories/update'),
    ]);

    $category = $this->invision->blogs()->categories()->update(new UpdateCategoryPayload(
        categoryId: 2,
        name: '::edited::',
    ));

    expect($category)
        ->toBeInstanceOf(BlogCategory::class)
        ->and($category->name)->toBe('::edited::');
});

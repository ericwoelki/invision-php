<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\Blogs\Requests\DeleteBlogRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\GetBlogRequest;
use EricWoelki\Invision\Applications\Blogs\Requests\ListBlogsRequest;
use EricWoelki\Invision\Data\Blog;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists blogs', function (): void {
    MockClient::global([
        ListBlogsRequest::class => new InvisionFixture('blogs/blogs/list'),
    ]);

    $blogs = $this->invision->blogs()->blogs()->list();

    expect($blogs)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Blog::class);
});

it('gets a blog', function (): void {
    MockClient::global([
        GetBlogRequest::class => new InvisionFixture('blogs/blogs/get'),
    ]);

    $blog = $this->invision->blogs()->blogs()->get(1);

    expect($blog)->toBeInstanceOf(Blog::class);
});

it('deletes a blog', function (): void {
    $mock = MockClient::global([
        DeleteBlogRequest::class => MockResponse::make(),
    ]);

    $this->invision->blogs()->blogs()->delete(1);

    $mock->assertSent(DeleteBlogRequest::class);
});

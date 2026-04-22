<?php

declare(strict_types=1);

use EricWoelki\Invision\Applications\System\Payloads\ListSearchResultsPayload;
use EricWoelki\Invision\Applications\System\Requests\ListSearchResultsRequest;
use EricWoelki\Invision\Applications\System\Requests\ListSearchTypesRequest;
use EricWoelki\Invision\Data\Result;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\InvisionFixture;

beforeEach(function (): void {
    $this->invision = invisionMock();
});

it('lists search types', function (): void {
    MockClient::global([
        ListSearchTypesRequest::class => new InvisionFixture('system/search/types'),
    ]);

    $types = $this->invision->system()->search()->types();

    expect($types)
        ->toBeArray()
        ->each->toBeString();
});

it('lists search results', function (): void {
    MockClient::global([
        ListSearchResultsRequest::class => new InvisionFixture('system/search/results'),
    ]);

    $results = $this->invision->system()->search()->results(new ListSearchResultsPayload(query: 'test'));

    expect($results)
        ->toBeArray()
        ->toContainOnlyInstancesOf(Result::class);
});

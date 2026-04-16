<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Override;
use Saloon\Http\Faking\Fixture;

final class InvisionFixture extends Fixture
{
    #[Override]
    protected function defineSensitiveHeaders(): array
    {
        return [
            'Set-Cookie' => 'REDACTED',
        ];
    }
}

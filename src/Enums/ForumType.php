<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Enums;

enum ForumType: string
{
    case Discussions = 'discussions';
    case Questions = 'questions';
    case Category = 'category';
    case Redirect = 'redirect';
}

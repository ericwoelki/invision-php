<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Enums;

enum ClubType: string
{
    case Public = 'public';
    case Open = 'open';
    case Closed = 'closed';
    case Private = 'private';
    case Readonly = 'readonly';
}

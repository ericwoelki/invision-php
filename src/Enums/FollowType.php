<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Enums;

enum FollowType: string
{
    case Immediate = 'immediate';
    case Daily = 'daily';
    case Weekly = 'weekly';
}

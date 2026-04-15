<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Enums;

enum ContentVisibility: int
{
    case Visible = 1;
    case Hidden = 0;
    case RequiresApproval = -1;
}

<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Enums;

enum EventAttendance: int
{
    case No = 0;
    case Yes = 1;
    case Maybe = 2;
}

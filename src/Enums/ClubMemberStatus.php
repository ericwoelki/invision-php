<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Enums;

enum ClubMemberStatus: string
{
    case Member = 'member';
    case Invited = 'invited';
    case Requested = 'requested';
    case Banned = 'banned';
    case Moderator = 'moderator';
    case Leader = 'leader';
}

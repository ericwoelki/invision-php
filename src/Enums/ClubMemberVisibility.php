<?php

declare(strict_types=1);

namespace EricWoelki\Invision\Enums;

enum ClubMemberVisibility: string
{
    case Public = 'nonmember';
    case Members = 'member';
    case Moderators = 'moderator';
}

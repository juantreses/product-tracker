<?php

namespace App\Enum;

enum HouseholdRole: string
{
    case CREATOR = 'creator';
    case ADMIN = 'admin';
    case MEMBER = 'member';
}

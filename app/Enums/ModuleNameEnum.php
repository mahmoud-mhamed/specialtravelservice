<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ModuleNameEnum: string
{
    use EnumOptionsTrait;
    case USERS='users';

    case BILL='bill';

}

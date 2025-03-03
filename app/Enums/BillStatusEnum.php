<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum BillStatusEnum: string
{
    use EnumOptionsTrait;
    case PENDING = 'pending';
    case PAID = 'paid';
}

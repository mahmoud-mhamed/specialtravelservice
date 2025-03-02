<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum BillPurchaseTypeEnum: string
{
    use EnumOptionsTrait;
    case INITIATIVE='initiative';
    case DISABILITY_ANSWER='disability_answer';
    case PERSONAL='personal';
}

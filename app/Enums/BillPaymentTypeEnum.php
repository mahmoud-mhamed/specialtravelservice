<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum BillPaymentTypeEnum: string
{
    use EnumOptionsTrait;

    case FROM_CLIENT = 'from_client';
    case TO_SUPPLIER = 'to_supplier';
}

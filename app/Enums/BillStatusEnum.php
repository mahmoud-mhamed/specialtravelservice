<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum BillStatusEnum: string
{
    use EnumOptionsTrait;
    case PENDING = 'pending';
    case PURCHASED = 'purchased';
    case SHIPPED = 'shipped';
    case IN_CUSTOMS = 'in_customs';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';
}

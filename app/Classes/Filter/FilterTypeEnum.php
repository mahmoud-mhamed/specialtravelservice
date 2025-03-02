<?php

namespace App\Classes\Filter;

enum FilterTypeEnum: string
{
    case DROPDOWN='dropdown';
    case MULTI_SELECT='multi_select';
    case DATE_RANGE='date_range';
}

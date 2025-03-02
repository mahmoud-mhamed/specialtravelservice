<?php

namespace App\Models\Filters\Bill;

use App\Classes\Filter\Filter;
use App\Classes\Filter\FilterTypeEnum;
use App\Enums\BillStatusEnum;
use Illuminate\Contracts\Support\Arrayable;

final class BillStatusFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum = FilterTypeEnum::DROPDOWN;
    public string $key = 'status';

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return BillStatusEnum::getOptionsData();
    }
}

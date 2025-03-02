<?php

namespace App\Models\Filters;

use App\Classes\Filter\FilterTypeEnum;
use App\Classes\Filter\Filter;

final class CreatedAtDateRangeFilter extends Filter
{
    public string $key = 'created_at';
    public FilterTypeEnum $filterTypeEnum=FilterTypeEnum::DATE_RANGE;

    public function __construct(public ?\Closure $callback=null) {}
}

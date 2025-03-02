<?php

namespace App\Models\Filters;

use App\Enums\IsActiveEnum;
use App\Classes\Filter\FilterTypeEnum;
use App\Classes\Filter\Filter;
use Illuminate\Contracts\Support\Arrayable;

final class ActiveFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum = FilterTypeEnum::DROPDOWN;
    public string $key = 'is_active';
    public bool $isInt = true;

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return IsActiveEnum::getOptionsData();
    }
}

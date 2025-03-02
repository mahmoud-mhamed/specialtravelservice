<?php

namespace App\Models\Filters;

use App\Models\User;
use App\Enums\IsActiveEnum;
use App\Classes\Filter\Filter;
use App\Classes\Filter\FilterTypeEnum;
use Illuminate\Contracts\Support\Arrayable;

final class UserFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum=FilterTypeEnum::MULTI_SELECT;
    public string $key = 'users';
    public bool $isInt = true;

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return User::get();
    }
}

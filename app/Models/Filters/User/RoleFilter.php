<?php

namespace App\Models\Filters\User;

use App\Models\User;
use App\Enums\IsActiveEnum;
use App\Classes\Filter\Filter;
use Silber\Bouncer\Database\Role;
use App\Classes\Filter\FilterTypeEnum;
use Illuminate\Contracts\Support\Arrayable;

final class RoleFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum=FilterTypeEnum::DROPDOWN;
    public string $key = 'role';
    public bool $isInt = true;

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return Role::select('id', 'title AS name')->get();
    }
}

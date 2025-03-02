<?php

namespace App\Models\Filters\Bill;

use App\Classes\Filter\Filter;
use App\Classes\Filter\FilterTypeEnum;
use App\Models\Client;
use Illuminate\Contracts\Support\Arrayable;

final class BillDisabledClientFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum = FilterTypeEnum::DROPDOWN;
    public string $key = 'disabled_client_id';
    public bool $isInt = true;

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return Client::query()->whereHas('disabledBills')->get();
    }
}

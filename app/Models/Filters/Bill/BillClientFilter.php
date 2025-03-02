<?php

namespace App\Models\Filters\Bill;

use App\Enums\IsActiveEnum;
use App\Classes\Filter\FilterTypeEnum;
use App\Classes\Filter\Filter;
use App\Models\Client;
use Illuminate\Contracts\Support\Arrayable;

final class BillClientFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum = FilterTypeEnum::DROPDOWN;
    public string $key = 'client_id';
    public bool $isInt = true;

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return Client::query()->whereHas('bills')->get();
    }
}

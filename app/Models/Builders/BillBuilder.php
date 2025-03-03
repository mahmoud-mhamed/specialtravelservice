<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Bill;
use App\Models\Filters\Bill\BillStatusFilter;
use App\Models\Filters\CreatedAtDateRangeFilter;

/**@mixin Bill */
class BillBuilder extends BaseBuilder
{
    use UseFilter;

    public function filters(): array
    {
        return [
            new BillStatusFilter(fn($value) => $this->forStatus($value)),
            new CreatedAtDateRangeFilter(fn($date) => $this->createdAtRange($date)),
        ];
    }

    public function forStatus(?string $value)
    {
        if (!$value)
            return $this;
        return $this->where('status', $value);
    }

}

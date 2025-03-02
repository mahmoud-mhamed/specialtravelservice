<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Client;
use App\Models\Filters\CreatedAtDateRangeFilter;

/**@mixin Client */
class ClientBuilder extends BaseBuilder
{
    use UseFilter;

    public function filters(): array
    {
        return [
            new CreatedAtDateRangeFilter(fn($date) => $this->createdAtRange($date)),
        ];
    }
}

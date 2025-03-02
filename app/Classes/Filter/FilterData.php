<?php

namespace App\Classes\Filter;

class FilterData
{
    /**
     * @param array $filters
     * @return array
     */
    public static function from(array $filters): array
    {
        $data = [];
        foreach ($filters as $filter) {
            /** @var Filter $filter */
            $filter = app($filter);
            unset($filter->callback);
            $data[$filter->key] = $filter->toArray();
        }
        return $data;
    }
}

<?php

namespace App\Classes\Filter;

use Illuminate\Support\Collection;

trait UseFilter
{
    /**
     * @return array<Filter>
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * @return $this
     */
    public function filter($filters = null, $ignore_filter = []): static
    {
        foreach ($this->filters() as $filter) {
            $value = $filters ? data_get($filters, $filter->key) : request($filter->key);
            if ($value !== null) {
                if (!$ignore_filter || !in_array(get_class($filter), $ignore_filter))
                    data_get($filter, 'callback')($value);
            }
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getFilters(): Collection
    {
        $filters = [];
        foreach ($this->filters() as $filter) {
            unset($filter->callback);
            $filters[$filter->key] = $filter->toArray();
        }
        return collect($filters);
    }


}

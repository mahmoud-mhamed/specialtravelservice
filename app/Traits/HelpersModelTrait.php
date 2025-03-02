<?php

namespace App\Traits;

use App\Classes\Helpmate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

trait HelpersModelTrait
{
    final public function createdAtRange(string|array|null $dateRange): static
    {
        return $this->rangeDateFilter($dateRange,'created_at');
    }


    /**
     * @param bool|null $active
     * @return $this
     */
    final public function isActive(?bool $active = null): static
    {
        return $this->when($active !== null, function (Builder $q) use ($active) {
            $q->where('is_active', $active);
        });
    }


    /**
     * @param string|null $dateRange
     * @return $this
     */
    final public function updatedAtRange(?string $dateRange): static
    {
        return $this->rangeDateFilter($dateRange,'updated_at');
    }

    public function rangeDateFilter($date_range,$column='created_at'): static
    {
        $date =Helpmate::getRangeFromRequestPeriod($date_range);
        return $this->when($date !== null,
            fn(Builder $q) => $q->whereDate($column, '>=', Arr::first($date))
                ->when(Arr::last($date) !== null, fn(Builder $q) => $q->whereDate($column, '<=', Arr::last($date)))
        );
    }

    public function search(array $columns = [], $search_key = null): static
    {
        $search_key = trim($search_key ?? request()->get('search'));
        if (!$search_key || !count($columns))
            return $this;
        $this->where(function ($q) use ($search_key, $columns) {
            $model_translatable_array = $this->model?->translatable && is_array($this->model->translatable) ? $this->model->translatable : [];
            //foreach search column
            foreach ($columns as $loop_key => $loop_option) {
                $search_key = "%$search_key%";
                $col_name = is_array($loop_option) ? $loop_key : $loop_option;
                $option = is_array($loop_option) ? $loop_option : null;

                if (in_array($col_name, $model_translatable_array)) {
                    $option['is_trans'] = true;
                }
                if (is_array($option)) {
                    if (data_get($option, 'is_relation')) {
                        $relation = explode('.', $col_name);
                        if (count($relation) === 2)
                            $q->orWhereHas($relation[0], fn($q) => $q->where($relation[1], 'like', $search_key));
                    } else if (data_get($option, 'is_trans')) {
                        if (data_get($option, 'all_lang')) {
                            $q->orWhere($col_name . '->ar', 'like', $search_key)->orWhere($col_name . '->en', 'like', $search_key);
                        } else {
                            $q->orWhere($col_name . '->' . App::getLocale(), 'like', $search_key);
                        }
                    }
                } else {
                    $q->orWhere($col_name, 'like', $search_key);
                }
            }
        });
        return $this;
    }

    final public function authDepartment(): static
    {
        if (!Auth::user()->department_id)
            return $this;
        return $this->where('department_id', Auth::user()->department_id);
    }

    final public function authCompany(): static
    {
        return $this->where('company_id', Auth::user()->company_id);
    }

    public function whereOrWhereIn($column, $values)
    {
        $count_values = count($values);
        if (!$values || $count_values === 0) {
            return $this;
        }
        if ($count_values == 1)
            return $this->where($column, $values[0]);
        return $this->whereIn($column, $values);
    }

    public function filterStatus($column_name, $values=[])
    {
        return $this->whereOrWhereIn($column_name, $values);
    }
}

<?php

namespace App\Classes\Filter;

use App\Classes\Filter\FilterTypeEnum;
use Closure;
use Illuminate\Contracts\Support\Arrayable;

abstract class Filter
{
    public string $key;
    public ?string $placeholder = null;

    public string $type;
    public FilterTypeEnum $filterTypeEnum;

    public ?Closure $callback;

    public bool $isInt = false;
    public bool $useCash = true;

    public bool $show = true;

    public string $search_url = '';

    public string $optionLabel = 'name';
    public int $min = 333;
    public int $max = 555;

    public static function getData(): null|Arrayable|array|string
    {
        return null;
    }

    public function toArray(): array
    {
        $type= $this->type??$this->filterTypeEnum->value;
        return [
            'type' =>$type,
            'placeholder' => $this->placeholder,
            'isInt' => $this->isInt,
            'show' => $this->show,
            'min' => $this->min,
            'max' => $this->max,
            'search_url' => $this->search_url,
            'optionLabel' => $this->optionLabel,
            'data' => $this->useCash ? \Cache::remember($type . $this->key, 10, fn() => static::getData()) : static::getData()
        ];
    }
}

<?php

namespace App\Traits;

use Illuminate\Support\Collection;

/**
 * used to get select option for enum .
 * @author mahmoud-mhamed <mahmoud1272022@gmail.com>
 */
trait EnumOptionsTrait
{
    public static function getOptionsData(): Collection
    {
        return collect(self::cases())->map(function ($row) {
            $item['id'] = $row;
            $item['name'] = self::getTrans($row);
            return $item;
        });
    }

    public static function getRandomCase()
    {
        return collect(self::cases())->random();
    }

    public static function getOptionsIdNameData(): Collection
    {
        return collect(self::cases())->map(function ($row) {
            $item['id'] = $row->value;
            $item['name'] = self::getTrans($row);
            return $item;
        });
    }

    public static function getOptionsPluckData(): array
    {
        $options = self::getOptionsData()->toArray();
        return array_combine(self::values(), array_column($options, 'name'));
    }

    public static function getTrans($case = null, $locale = null): ?string
    {
        return $case ? __('enums.' . class_basename(__CLASS__) . '.' . ($case?->value ?? $case), [], $locale) : null;
    }

    public static function getEnumFromValue($value)
    {
        return collect(self::cases())->where('value', $value)->first();
    }

    public static function getFileName(): string
    {
        return class_basename(self::class);
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public function translate(): string
    {
        return self::getTrans($this);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

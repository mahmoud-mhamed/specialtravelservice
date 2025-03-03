<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;
use Illuminate\Support\Collection;

enum IsActiveEnum: int
{
    use EnumOptionsTrait;

    case ACTIVE = 1;
    case NOT_ACTIVE = 0;

    public static function getOptionsData(): Collection
    {
        return collect(self::cases())->map(function ($row) {
            $item['id'] = (bool)$row->value;
            $item['name'] = $row == self::ACTIVE ? __('message.active') : __('message.not_active');
            return $item;
        });
    }
}

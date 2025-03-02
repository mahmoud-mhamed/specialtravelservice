<?php

namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;

class Helpmate
{
    public static function unsetArray(&$array, $unset_array)
    {
        foreach ($unset_array as $item) {
            unset($array[$item]);
        }
        return $array;
    }

    public static function getRangeFromRequestPeriod($i): ?array
    {
        if (!$i) return null;

        if (is_string($i)) {
            $date = explode(' - ', $i);
            return [Arr::first($date), Arr::last($date)];
        }

        if (is_array($i)) {
            $range[0] = !empty($i[0]) ? Carbon::create($i[0])->format('Y-m-d') . ' 00:00:00' : null;
            $range[1] = !empty($i[1]) ? Carbon::create($i[1])->format('Y-m-d') . ' 00:00:00' : null;

            return $range;
        }

        if (!is_array($i) || count($i) != 2)
            return null;
        $range = [];
        $first_data = $i['startDate'];
        $second_data = $i['endDate'];
        $range[0] = Carbon::create($first_data)->format('Y-m-d') . ' 00:00:00';
        $range[1] = Carbon::create($second_data)->format('Y-m-d') . ' 23:59:59';
        return $range;
    }

    public static function clearCache(): void
    {
        Artisan::call('cache:clear');
    }

    public static function toFixed($number, $decimals = 4): null|float|int
    {
        if (!$number)
            return null;
        $data=explode('.',$number);
        return (data_get($data,0,0).'.'.substr(data_get($data,1,''), 0, $decimals))*1;
    }

    public static function getModelDataForDropdown($model, $idColumn, $nameColumn): array
    {
        $data = [];

        foreach ($model as $item){
            $data[]= [
                'id' => $item->{$idColumn},
                'name' => $item->{$nameColumn},
            ];
        }

        return $data;
    }

    public static function convertSizeToReadFormat($s): ?string
    {
        $size = ['KB', 'MB', 'GB', 'TB'];
        $current_s_type = 0;
        for ($i = 0, $iMax = count($size); $i < $iMax; $i++) {
            if ($s > 1024) {
                $current_s_type = $i;
                $s /= 1024;
            }
        }
        return $s ? round($s, 2) . ' ' . $size[$current_s_type] : null;
    }

    public static function addStringBeforeSearchOrEnd($string,$search,$add_before_search): string
    {
        $search_position = strrpos($string, $search);

        if ($search_position !== false) {
            return substr($string, 0, $search_position) . $add_before_search . substr($string, $search_position);
        } else {
            return $string . $add_before_search;
        }
    }
}

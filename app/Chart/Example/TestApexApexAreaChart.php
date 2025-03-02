<?php

namespace App\Chart\Example;

use App\Chart\Src\DataSet;
use App\Chart\Src\Types\ApexAreaChart;
use Illuminate\Support\Collection;

class TestApexApexAreaChart extends ApexAreaChart
{
    public function getCollection(): Collection
    {
        $response = collect();
        for ($i = 0; $i < 12; $i++) {
            $response->push([
                'month_name' => 'test-'.$i + 1,
                'total' => random_int(100, 250)
            ]);
        }
        return $response;
    }


    public function getLabels(): array
    {
        return $this->result->pluck('month_name')->toArray();
    }

    public function getDataSets(): array
    {
        return [
            DataSet::make()->setLabel('value')
                ->setData($this->result->pluck('total')->toArray())
//                ->setBackgroundColor(DataSet::getColors( 12,0))
                ->toArray(),
        ];
    }


    public function canAccess(): bool
    {
        return true;
    }
}

<?php

namespace App\Chart\Src\Types;

use App\Chart\Src\ApexChart;
use App\Chart\Src\ChartBase;
use App\Chart\Src\Options\ChartOptions;

class SemiDonutChart extends ChartBase
{
    protected ElChartType $type = ElChartType::DOUGHNUT;

    public function getDefaultOptions(): ChartOptions
    {
        return ChartOptions::make()->setBorderRadius(borderRadius: 20)->setSemi();
    }

    public function getChart(): ApexChart
    {
        return $this->apexChart()->setType($this->type)
            ->setSemi();
    }
}

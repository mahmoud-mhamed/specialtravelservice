<?php

namespace App\Chart\Src\Types;

use App\Chart\Src\ChartBase;
use App\Chart\Src\Options\ChartOptions;

class DoughnutChart extends ChartBase
{
    protected ElChartType $type = ElChartType::DOUGHNUT;

    public function getDefaultOptions(): ChartOptions
    {
        return ChartOptions::make()->setBorderRadius(10);
    }

}

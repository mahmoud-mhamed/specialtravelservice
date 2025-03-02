<?php

namespace App\Chart\Src\Types;

use App\Chart\Src\ChartBase;
use App\Chart\Src\Options\ChartOptions;

class BarChart extends ChartBase
{
    protected ElChartType $type = ElChartType::BAR;

    public function getDefaultOptions(): ChartOptions
    {
        return ChartOptions::make()
            ->setBorderRadius(50);
    }
}

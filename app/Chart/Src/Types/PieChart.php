<?php

namespace App\Chart\Src\Types;

use App\Chart\Src\ChartBase;
use App\Chart\Src\Options\ChartOptions;

class PieChart extends ChartBase
{
    protected ElChartType $type = ElChartType::PIE;

    public function getDefaultOptions(): ChartOptions
    {
        return ChartOptions::make()
            ->setBorderRadius(10)
            ->setDataLabels();
    }
}

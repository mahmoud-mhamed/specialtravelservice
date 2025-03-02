<?php

namespace App\Chart\Src\Types;

use App\Chart\Src\ChartBase;

class LineChart extends ChartBase
{
    protected ElChartType $type = ElChartType::LINE;
}

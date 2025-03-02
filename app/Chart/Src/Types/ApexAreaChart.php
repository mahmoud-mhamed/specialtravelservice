<?php

namespace App\Chart\Src\Types;

use App\Chart\Src\ApexChart;
use App\Chart\Src\ChartBase;

class ApexAreaChart extends ChartBase
{
    protected ElChartType $type = ElChartType::APEX_AREA;

    public function getChart(): ApexChart
    {
        return $this->apexChart()->setType($this->type);
    }
}

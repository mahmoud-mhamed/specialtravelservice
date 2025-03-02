<?php
namespace App\Chart\Src\Types;

enum ElChartType: string
{
    case DOUGHNUT='doughnut';
    case PIE='pie';
    case LINE='line';
    case POLAR_AREA='polarArea';
    case BAR='bar';
    case APEX_AREA='area';


    public static function getApexTypes(): array
    {
        return [
            self::APEX_AREA,
        ];
    }
}

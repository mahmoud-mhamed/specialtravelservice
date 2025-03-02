<?php

namespace App\Chart\Src;


use App\Chart\Src\Options\ChartOptions;
use App\Chart\Src\Types\ElChartType;
use Illuminate\Support\Collection;

trait ChartTrait
{
    /**
     * @var ElChartType
     */
    protected ElChartType $type;

    public ?Collection $result = null;

    /**
     * @var bool
     */
    protected bool $stacked;

    /**
     * @return array<string>
     */
    public function getLabels(): array
    {
        return [];
    }

    public function canAccess(): bool
    {
        return true;
    }

    /**
     * @return array<DataSet>
     */
    public function getDataSets(): array
    {
        return [];
    }

    /**
     * @return ChartOptions
     */
    public function getOptions(): ChartOptions
    {
        return ChartOptions::make();
    }

    public function userHasPermission(): bool
    {
        return true;
    }

    public function getDefaults(): ChartOptions
    {
        return ChartOptions::make();
    }

    public function getDefaultOptions(): ChartOptions
    {
        return ChartOptions::make();
    }

    public function getCollection(): Collection
    {
        return $this->result ?? collect([]);
    }

    public function getChart(): ?ApexChart
    {
        return null;
    }

    public function getChartData(): ChartData
    {
        return ChartData::make()
            ->setLabels(labels: $this->getLabels())
            ->setDatasets(datasets: $this->getDataSets());
    }

}

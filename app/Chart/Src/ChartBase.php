<?php

namespace App\Chart\Src;

use App\Chart\Src\Options\ChartFontOptions;
use App\Chart\Src\Options\ChartOptions;
use App\Chart\Src\Types\ElChartType;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class ChartBase
{
    use ChartTrait, AsAction;

    final public function handle(): array
    {
        return $this->toArray();
    }

    /**
     * @return array|null
     */
    private function toArray(): ?array
    {
        if (!$this->userHasPermission()) {
            return null;
        }
        $this->result = $this->getCollection();
        return [
            'path' => $this->getPath(),
            'type' => $this->type,
            'data' => $this->getChartData()->toArray(),
            'options' => array_merge($this->getDefaultOptions()->toArray(), $this->getOptions()->toArray()),
            'defaults' => $this->getDefaults()->toArray(),
            'filters' => $this->getFilters(),
        ];
    }

    public function toVue(): ?array
    {
        if (!$this->canAccess()) {
            return null;
        }
        $type=$this->type;
        if (in_array($type,ElChartType::getApexTypes()) && $this->getChart()) {
            return $this->build();
        }
        return $this->toArray();
    }

    public function getDefaults(): ChartOptions
    {
        return ChartOptions::make()
            ->setDefaults(font: new ChartFontOptions(family: 'Tajawal', size: 12));
    }

    public function getFilters(): Collection
    {
        return collect([]);
    }

    private function getPath()
    {
        return str(static::class);
    }

    protected function apexChart(): ApexChart
    {
        return app(ApexChart::class);
    }

    public function build(): ?array
    {
        if (!$this->userHasPermission()) {
            return null;
        }
        $this->result = $this->getCollection();
        $chart = $this->getChart();
        $chart?->setLabels($this->getLabels());
        foreach ($this->getDataSets() as $dataSet) {
            if (!in_array($chart?->getType(), [ElChartType::APEX_AREA]) && count($this->getDataSets()) === 1) {
                $chart?->setData(data_get($dataSet, 'data'));
            } else {
                $chart?->setDataset(data_get($dataSet, 'label'), data_get($dataSet, 'data'));
            }
        }
        return [
            'path' => $this->getPath(),
            'filters' => $this->getFilters(),
            ...$chart?->toArray()
        ];
        return $chart?->toArray();
    }
}

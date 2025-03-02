<?php

namespace App\Chart\Src;

use App\Chart\Src\Options\ChartOptions;

final class SimpleChart extends ChartBase
{
    public function __construct(private readonly ChartData    $chartData,
                                private readonly ChartOptions $chartOptions)
    {
    }

    public static function make()
    {
        return app(__CLASS__);
    }

    /**
     * @param int|null $borderRadius
     * @return $this
     */
    public function setBorderRadius(?int $borderRadius = 10): self
    {
        $this->chartOptions->setBorderRadius($borderRadius);
        return $this;
    }

    /**
     * @return $this
     */
    public function spark(): self
    {
        $this->chartOptions
            ->setLabelsOptions(display: false)
            ->hideXGrid()
            ->hideYGrid()
            ->hideX()
            ->hideY();
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->chartOptions->setTitle(text: $title);
        return $this;
    }

    public function pie(bool $isSemi = false): self
    {
        $this->type = 'pie';
        $this->chartOptions->setDataLabels();
        if ($isSemi) {
            $this->chartOptions->setSemi();
        }
        return $this;
    }

    public function doughnut(bool $isSemi = false): self
    {
        $this->type = 'doughnut';
        if ($isSemi) {
            $this->chartOptions->setSemi();
        }
        return $this;
    }

    public function bar(bool $stacked = false): self
    {
        $this->type = 'bar';
        if ($stacked) {
            $this->chartOptions->setBorderRadius(0)->setStacked();
        }
        return $this;
    }

    public function line(): self
    {
        $this->type = 'line';
        $this->chartOptions->setStacked()->tension();
        return $this;
    }

    public function polarArea(): self
    {
        $this->type = 'polarArea';
        return $this;
    }

    public function radar(): self
    {
        $this->type = 'radar';
        return $this;
    }

    public function bubble(): self
    {
        $this->type = 'bubble';
        return $this;
    }

    /**
     * @param array $labels
     * @return $this
     */
    public function setLabels(array $labels): self
    {
        $this->chartData->setLabels($labels);
        return $this;
    }

    /**
     * @param string $label
     * @param array $data
     * @param int|string|array|null $color
     * @param int|null $borderColor
     * @param bool|null $fill
     * @return $this
     */
    public function setDataset(string                $label,
                               array                 $data,
                               null|int|string|array $color = null,
                               ?int                  $borderColor = null,
                               ?bool                 $fill = null): self
    {
        $dataSet = DataSet::make()
            ->setData(data: $data)
            ->setLabel(label: $label);
        if (is_int($color) || is_string($color)) {
            $dataSet->setBackgroundColor(is_string($color) ? $color : DataSet::getColors()[$color]);
        } elseif (is_array($color)) {
            $dataSet->setBackgroundColor($color);
        } else {
            $dataSet->setBackgroundColor(DataSet::getColors(take: count($data)));
        }
        if ($borderColor) {
            $dataSet->setBorderColor(DataSet::getColors()[$borderColor]);
        }
        $dataSet->setFill($fill);
        $this->chartData->setDataset($dataSet->toArray());
        return $this;
    }

    public function getChartData(): ChartData
    {
        return $this->chartData;
    }

    public function getOptions(): ChartOptions
    {
        return $this->chartOptions;
    }

}

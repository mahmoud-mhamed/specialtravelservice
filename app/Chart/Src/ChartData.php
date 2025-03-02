<?php

namespace App\Chart\Src;

class ChartData
{
    public function __construct(public ?array $labels = [],
                                public ?array $datasets = [])
    {
    }

    /**
     * @param array $labels
     * @return ChartData
     */
    public function setLabels(array $labels): self
    {
        $this->labels = $labels;
        return $this;
    }

    /**
     * @param array $datasets
     * @return ChartData
     */
    public function setDatasets(array $datasets): self
    {
        $this->datasets = $datasets;
        return $this;
    }

    /**
     * @param array $datasets
     * @return ChartData
     */
    public function setDataset(array $datasets): self
    {
        $this->datasets[] = $datasets;
        return $this;
    }

    /**
     * @return self
     */
    final public static function make(): self
    {
        return app(__CLASS__);
    }

    final public function toArray(): array
    {
        return array_filter(get_object_vars($this), static fn($item) => $item !== null);
    }
}

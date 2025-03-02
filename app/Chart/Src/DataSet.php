<?php

namespace App\Chart\Src;

use App\Chart\Src\Types\ElChartType;

class DataSet
{

    public ?array $data;
    public null|string|array $backgroundColor;
    public ?string $yAxisID = null;
    public ?ElChartType $type = null;
    public array|string|null $hoverBackgroundColor = null;
    public string|null $label = null;
    public string|null $borderColor = null;
    public int|null $borderWidth = null;
    public int|null $borderRadius = null;
    public bool|null $borderSkipped = false;
    public bool|null $fill = false;
    public float|null $lineTension = 0.5;


    /**
     * @return static
     */
    public static function make(): self
    {
        return app()->make(__CLASS__);
    }

    /**
     * @param array $data
     * @return DataSet
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param array|string $colors
     * @return DataSet
     */
    public function setBackgroundColor(array|string $colors): self
    {
        $this->backgroundColor = $colors;
        return $this;
    }

    /**
     * @param string|null $yAxisID
     * @return DataSet
     */
    public function setYAxisID(?string $yAxisID): self
    {
        $this->yAxisID = $yAxisID;
        return $this;
    }

    /**
     * @param ElChartType|null $type
     * @return DataSet
     */
    public function setType(?ElChartType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param array|string|null $hoverBackgroundColor
     * @return DataSet
     */
    public function setHoverBackgroundColor(array|string|null $hoverBackgroundColor): self
    {
        $this->hoverBackgroundColor = $hoverBackgroundColor;
        return $this;
    }

    /**
     * @param string|null $label
     * @return DataSet
     */
    public function setLabel(?string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param string|null $borderColor
     * @return DataSet
     */
    public function setBorderColor(?string $borderColor): self
    {
        $this->borderColor = $borderColor;
        return $this;
    }

    /**
     * @param int|null $borderWidth
     * @return DataSet
     */
    public function setBorderWidth(?int $borderWidth): self
    {
        $this->borderWidth = $borderWidth;
        return $this;
    }

    /**
     * @param int|null $borderRadius
     * @return DataSet
     */
    public function setBorderRadius(?int $borderRadius): self
    {
        $this->borderRadius = $borderRadius;
        return $this;
    }

    /**
     * @param bool|null $borderSkipped
     * @return DataSet
     */
    public function setBorderSkipped(?bool $borderSkipped): self
    {
        $this->borderSkipped = $borderSkipped;
        return $this;
    }

    /**
     * @param bool|null $fill
     * @return DataSet
     */
    public function setFill(?bool $fill): self
    {
        $this->fill = $fill;
        return $this;
    }

    /**
     * @param float|null $lineTension
     */
    public function setLineTension(?float $lineTension): void
    {
        $this->lineTension = $lineTension;
    }


    final public function toArray(): array
    {
        return array_filter(get_object_vars($this), static fn($item) => $item !== null);
    }

    final public static function getColors(int $take = 20, int $skip = 0): array
    {
        return collect(config('charts.colors'))->skip($skip)->take($take)->values()->toArray();
    }

    final public static function ConvertHexToRgbaColors($hex, $a = 1): string
    {
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        return "rgba($r,$g,$b,$a)";
    }
}

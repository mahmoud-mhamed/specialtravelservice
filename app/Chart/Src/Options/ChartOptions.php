<?php

namespace App\Chart\Src\Options;

class ChartOptions
{
    /**
     * @var array|null
     */
    public ?array $plugins = null;

    /**
     * @var array|null
     */
    public ?array $layout = null;

    /**
     * @var bool
     */
    public bool $responsive = true;

    public int $borderRadius;
    public int $maxBarThickness = 15;
    public float $tension;

    public string $indexAxis;

    /**
     * @var ChartFontOptions|null
     */
    public ?ChartFontOptions $font = null;

    public ?int $rotation = null;
    public ?int $cutoutPercentage = null;
    public ?int $circumference = null;

    final public static function make(): self
    {
        return (new static);
    }

    public function setTitle(bool $display = true, ?string $text = null, ?string $position = null): self
    {
        $this->dataPush('plugins.title', compact('display', 'text', 'position'));
        return $this;
    }

    public function setSubTitle(bool $display = true, ?string $text = null, ?string $position = null): self
    {
        $this->dataPush('plugins.subtitle', compact('display', 'text', 'position'));
        return $this;
    }

    public function setLabelsOptions(bool              $display = true,
                                     ?string           $position = null,
                                     ?bool             $rtl = null,
                                     ?ChartFontOptions $font = null): self
    {
        $this->dataPush('plugins.legend', compact('display', 'position', 'rtl'));
        $this->dataPush('plugins.legend.labels.font', $font?->toArray());
        return $this;
    }

    public function setLabelBoxSize(?int $boxWidth = null, ?int $boxHeight = null): self
    {
        $this->dataPush('plugins.legend.labels', compact('boxWidth', 'boxHeight'));
        return $this;
    }

    /**
     * @param bool|null $responsive
     * @return ChartOptions
     */
    public function setResponsive(?bool $responsive): self
    {
        $this->responsive = $responsive;
        return $this;
    }

    /**
     * @param string|null $top
     * @param string|null $right
     * @param string|null $bottom
     * @param string|null $left
     * @return $this
     */
    public function setLayoutPadding(?string $top = null,
                                     ?string $right = null,
                                     ?string $bottom = null,
                                     ?string $left = null): self
    {
        $this->dataPush('layout.padding', compact('top', 'right', 'bottom', 'left'));
        return $this;
    }

    /**
     * @param ChartFontOptions|null $font
     * @return $this
     */
    final public function setDefaults(?ChartFontOptions $font): self
    {
        $this->font = $font;
        return $this;
    }

    /**
     * @param bool $stacked
     * @return $this
     */
    final public function setStacked(bool $stacked = true): self
    {
        $this->dataPush('scales.x', ['stacked' => $stacked]);
        $this->dataPush('scales.y', ['stacked' => $stacked]);
        return $this;
    }

    final public function hideY(): self
    {
        $this->dataPush('scales.y', ['display' => false]);
        return $this;
    }

    final public function hideX(): self
    {
        $this->dataPush('scales.x', ['display' => false]);
        return $this;
    }

    final public function hideYGrid(): self
    {
        $this->dataPush('scales.y.grid', ['display' => false]);
        return $this;
    }

    final public function hideXGrid(): self
    {
        $this->dataPush('scales.x.grid', ['display' => false]);
        return $this;
    }

    final public function tension($tension = 0.4): self
    {
        $this->dataPush('elements.line', ['tension' => $tension]);
        return $this;
    }

    private function dataPush(string $path, ?array $value = null): void
    {
        data_set($this, $path, array_merge(data_get($this, $path) ?? [], array_filter($value ?? [], static fn($item) => $item !== null)));
    }


    final public function toArray(): array
    {
        return array_filter(get_object_vars($this), static fn($item) => $item !== null);
    }

    /**
     * @param int $borderRadius
     * @return ChartOptions
     */
    public function setBorderRadius(int $borderRadius): self
    {
        $this->borderRadius = $borderRadius;
        return $this;
    }

    /**
     * @param bool $isHorizontal
     * @return ChartOptions
     */
    public function setBarHorizontal(bool $isHorizontal = true): self
    {
        $this->indexAxis = $isHorizontal ? 'y' : null;
        return $this;
    }

    public function setSemi(): self
    {
        $this->rotation = -90;
        $this->cutoutPercentage = 30;
        $this->circumference = 180;
        return $this;
    }

    public function setDataLabels(bool   $display = true,
                                  string $color = '#ffffff',
                                  string $size = '16px',
                                  string $align = 'right',
                                  string $anchor = 'center'): self
    {
        $this->dataPush('plugins.datalabels', [
            'display' => $display,
            'color' => $color,
            'anchor' => $anchor,
            'align' => $align,
            'font' => ['size' => $size]
        ]);
        return $this;
    }

}

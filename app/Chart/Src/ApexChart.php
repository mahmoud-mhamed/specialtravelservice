<?php

namespace App\Chart\Src;

use App\Chart\Src\Types\ElChartType;
use Illuminate\Support\Str;

class ApexChart
{
    /*
    |--------------------------------------------------------------------------
    | Chart
    |--------------------------------------------------------------------------
    |
    | This class build the chart by passing setters to the object, it will
    | use the method container and scripts to generate a JSON
    | in blade views, it works also with Vue JS components
    |
    */

    public string $id;
    protected ?string $title = null;
    protected ?string $subtitle = null;
    protected ?string $subtitlePosition = null;
    protected array $labels = [];
    protected ?string $fontFamily = null;
    protected ?string $foreColor = null;
    protected array $dataset = [];
    protected int $height = 400;
    protected string $width = '100%';
    protected array $colors = [];
    protected array $horizontal = [];
    protected array $xAxis = [];
    protected array $grid = [];
    protected array $markers = [];
    protected array $stroke = [];
    protected array $toolbar = [];
    protected array $zoom = [];
    protected array $dataLabels = [];
    protected array $sparkline = [];

    /*
    |--------------------------------------------------------------------------
    | Constructors
    |--------------------------------------------------------------------------
    */
    private array $barOptions = [];
    private array $legendOptions = [];
    private array $semi = [];

    public function __construct()
    {
        $this->id = Str::uuid();
        $this->horizontal = ['horizontal' => false];
        $this->colors = config('charts.colors');
        $this->setXAxis([]);
        $this->grid = ['show' => false];
        $this->markers = ['show' => false];
        $this->toolbar = ['show' => false];
        $this->zoom = ['enabled' => true];
        $this->dataLabels = ['enabled' => true];
        $this->sparkline = ['enabled' => false];
        $this->fontFamily = config('charts.font_family');
        $this->foreColor = config('charts.font_color');
    }

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */

    /**
     *
     * @param ElChartType|null $type
     * @return $this
     */
    public function setType(ElChartType $type = null): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): ElChartType
    {
        return $this->type;
    }

    public function setFontFamily($fontFamily): self
    {
        $this->fontFamily = $fontFamily;
        return $this;
    }

    public function setFontColor($fontColor): self
    {
        $this->foreColor = $fontColor;
        return $this;
    }


    public function setDataset(?string $name = null, array $data = []): self
    {
        $this->dataset[] = array_filter(compact('name', 'data'));
        return $this;
    }

    public function setData(array $data = []): self
    {
        $this->dataset = $data;
        return $this;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    public function setColors(array $colors): self
    {
        $this->colors = $colors;
        return $this;
    }

    public function setHorizontal(bool $horizontal): self
    {
        $this->horizontal = ['horizontal' => $horizontal];
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setSubtitle(string $subtitle, string $position = 'left'): self
    {
        $this->subtitle = $subtitle;
        $this->subtitlePosition = $position;
        return $this;
    }

    public function setLabels(array $labels): self
    {
        $this->labels = $labels;
        return $this;
    }

    public function setXAxis(array $categories): self
    {
        $this->xAxis = $categories;
        return $this;
    }

    public function setGrid($color = '#e5e5e5', $opacity = 0.1): self
    {
        $this->grid = [
            'show' => true,
            'row' => [
                'colors' => [$color, 'transparent'],
                'opacity' => $opacity,
            ],
        ];

        return $this;
    }

    public function setMarkers($colors = [], $width = 4, $hoverSize = 7): self
    {
        if (empty($colors)) {
            $colors = $this->colors;
        }

        $this->markers = [
            'size' => $width,
            'colors' => $colors,
            'strokeColors' => "#fff",
            'strokeWidth' => $width / 2,
            'hover' => [
                'size' => $hoverSize,
            ]
        ];

        return $this;
    }

    public function setStroke(int $width = 2): self
    {

        $this->stroke = [
            'show' => true,
            'width' => $width,
            'curve' => 'smooth',
            'lineCap' => "round",
        ];
        return $this;
    }

    public function setToolbar(bool $show, bool $zoom = true): self
    {
        $this->toolbar = ['show' => $show];
        $this->zoom = ['enabled' => $zoom ?: false];
        return $this;
    }

    public function setDataLabels(bool $enabled = true): self
    {
        $this->dataLabels = ['enabled' => $enabled,
            'textAnchor' => 'start', 'offsetX' => 20,];
        return $this;
    }

    public function setSparkline(bool $enabled = true): self
    {
        $this->sparkline = ['enabled' => $enabled];
        return $this;
    }

    public function setBarOptions(?bool $horizontal = false, int $borderRadius = 25): self
    {
        $this->barOptions = [
            'horizontal' => $horizontal,
            'borderRadius' => $borderRadius,
            'columnWidth' => '20px',
            'borderRadiusApplication' => 'end',
            'distributed' => true
        ];
        return $this;
    }

    public function setLabelsOptions(bool $show = true, string $position = "bottom"): self
    {
        $this->legendOptions = [
            'show' => $show,
            'position' => $position,
            'verticalAlign' => "start",
            'horizontalAlign' => 'right',
            'itemMargin' => [
                'horizontal' => 5,
                'vertical' => 0,
            ],
            'markers' => [
                'offsetX' => 3,
            ]
        ];
        return $this;
    }

    public function setSemi(): self
    {
        $this->semi = [
            'startAngle' => -90,
            'endAngle' => 90,
            'offsetY' => 10
        ];
        return $this;
    }


    public function toArray(): array
    {
        $options = array_filter([
            'chart' => [
                'height' => $this->height,
                'toolbar' => $this->toolbar,
                'zoom' => $this->zoom,
                'fontFamily' => $this->fontFamily,
                'foreColor' => $this->foreColor,
                'sparkline' => $this->sparkline,
            ],
//            'plotOptions' => [
//                'bar' => array_filter($this->barOptions),
//                'pie' => array_filter(array_merge($this->semi))
//                /*'pie' => [
//                    'donut' => [
//                        'size' => '60%',
//                        'background' => null,
//                        'labels' => [
//                            'show' => true,
//                            'name' => [
//                                'show' => true,
//                                //'fontSize' => '22px',
//                                'fontFamily' => $this->fontFamily,
//                                'fontWeight' => 600,
//                                'offsetY' => -10,
//                            ],
//                            'value' => [
//                                'show' => true,
//                                //'fontSize' => '16px',
//                                'fontFamily' => $this->fontFamily,
//                                'fontWeight' => 400,
//                                'offsetY' => 16,
//                            ],
//                            'total' => [
//                                'show' => true,
//                                'showAlways' => false,
//                                'label' => 'إجمالي',
//                               // 'fontSize' => '22px',
//                                'fontFamily' => $this->fontFamily,
//                                'fontWeight' => 600,
//                                //'color' => '#373d3f',
//                            ],
//                        ],
//                    ]
//                ],*/
//            ],
            'colors' => $this->colors,
            'dataLabels' => $this->dataLabels,
            'title' => [
                'text' => $this->title ?? '',
                'align' => 'center'
            ],
            'subtitle' => [
                'text' => $this->subtitle ?: '',
                'align' => $this->subtitlePosition ?: '',
            ],
            'xaxis' => [
                'categories' => $this->xAxis,
            ],
            'grid' => $this->grid,
            'markers' => $this->markers,
            'legend' => $this->legendOptions,
            'states' => [
                'hover' => [
                    'filter' => [
                        'type' => 'lighten',
                        'value' => 0.001
                    ]
                ]
            ],
            'strokeLinecap' => 'round'
        ]);

        if ($this->labels) {
            $options['labels'] = $this->labels;
        }

        if ($this->stroke) {
            $options['stroke'] = $this->stroke;
        }

        return [
            'height' => $this->height,
            'width' => $this->width,
            'type' => $this->type,
            'options' => $options,
            'series' => $this->dataset,
        ];
    }

}

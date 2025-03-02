<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ExcelExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

    private const TRANS_HEADER_KEY = 'column';
    private const BOOLEAN_FIELDS = ['is_active', 'is_completed'];


    private Collection $collection;
    private array $headers;
    private array $mappings;

    /**
     * $map=[
     *  'id',
     *  'user.name',
     *  'column_header' => column_name,
     *  'column_header' => user.name
     *  'column_header' => Closure function($row){}
     * ]
     */

    public function __construct(Collection $collection, array $map)
    {
        $this->collection = $collection;
        $this->processMap($map);
    }
    private function processMap(array $map): void
    {
        $headers = [];
        $mappings = [];

        foreach ($map as $key => $value) {
            $headers[] = is_int($key) ? $this->formatTitle($value) : $this->formatTitle($key);
            $mappings[] = $value;
        }

        $this->headers = $headers;
        $this->mappings = $mappings;
    }

    public function collection(): Collection
    {
        return $this->collection;
    }

    private function formatTitle(string $title): string
    {
        $title = str_replace('_text', '', $title);
        $lastDotPosition = strrpos($title, '.');

        if ($lastDotPosition !== false) {
            $title = substr($title, $lastDotPosition + 1);
        }

        $translatedTitle = __(self::TRANS_HEADER_KEY . ".$title");
        return str_contains($translatedTitle, self::TRANS_HEADER_KEY) ? $title : $translatedTitle;
    }


    public function headings(): array
    {
        return $this->headers;
    }

    #[NoReturn]
    public function map($row): array
    {
        return array_map(function ($mapping) use ($row) {
            if (is_callable($mapping)) {
                return $mapping($row);
            }

            return $this->resolveValue($row, $mapping);
        }, $this->mappings);
    }
    private function resolveValue($data, string $path)
    {
        $value = $data;
        foreach (explode('.', $path) as $segment) {
            $value = $value[$segment] ?? null;

            if (in_array($segment, self::BOOLEAN_FIELDS)) {
                return $value == 1 ? __('message.yes') : __('message.no');
            }
        }

        return $value;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(app()->isLocal() == 'ar');
            },
        ];
    }
}

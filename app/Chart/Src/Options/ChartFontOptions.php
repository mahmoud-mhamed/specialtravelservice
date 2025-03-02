<?php

namespace App\Chart\Src\Options;

class ChartFontOptions
{
    public function __construct(public readonly ?string $family = null,
                                public readonly ?int    $size = null,
                                public readonly ?string $weight = null,
                                public readonly ?string $lineHeight = null)
    {
    }

    final public function toArray(): array
    {
        return array_filter(get_object_vars($this), static fn($item) => $item !== null);
    }

}

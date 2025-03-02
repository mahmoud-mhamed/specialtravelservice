<?php

namespace App\Traits;

trait PaginatableTrait
{
    public function getPerPage()
    {
        return request('rows') ?? 10;
    }
}

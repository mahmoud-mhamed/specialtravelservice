<?php

namespace App\Models;


use App\Models\Builders\CurrencyBuilder;
use App\Models\BaseModel;

/**
 * @property string name
 * @property string code
 */
class Currency extends BaseModel
{
    protected $fillable = [
        'name', 'code',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    /**
     * @return CurrencyBuilder
     */
    public static function query(): CurrencyBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return CurrencyBuilder
     */
    public function newEloquentBuilder($query): CurrencyBuilder
    {
        return new CurrencyBuilder($query);
    }
}

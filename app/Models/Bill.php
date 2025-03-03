<?php

namespace App\Models;


use App\Enums\BillStatusEnum;
use App\Models\Builders\BillBuilder;
use App\Observers\BillObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

/**
 * @property int $id
 * @property string client_name
 * @property string service
 * @property string notes
 * @property string price
 * @property string status
 */
#[ObservedBy([BillObserver::class])]
class Bill extends BaseModel
{
    protected $fillable = [
        'client_name', 'service', 'notes', 'price', 'status',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];


    protected function casts(): array
    {
        return [
            'status' => BillStatusEnum::class,
        ];
    }
    /**
     * @return BillBuilder
     */
    public static function query(): BillBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return BillBuilder
     */
    public function newEloquentBuilder($query): BillBuilder
    {
        return new BillBuilder($query);
    }
}

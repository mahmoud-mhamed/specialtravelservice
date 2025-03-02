<?php

namespace App\Traits;

use App\Models\City;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read City $area
 * @property-read City $city
 * @property-read City $block
*/
trait ModelCityRelationTrait
{
    public function area(): BelongsTo
    {
        return $this->belongsTo(City::class,'area_id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function block(): BelongsTo
    {
        return $this->belongsTo(City::class,'block_id');
    }
}

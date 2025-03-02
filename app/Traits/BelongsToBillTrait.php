<?php

namespace App\Traits;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int bill_id;
 * @property-read Bill $bill;
 */
trait BelongsToBillTrait
{
    final public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
}

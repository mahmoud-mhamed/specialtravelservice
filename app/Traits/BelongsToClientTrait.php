<?php

namespace App\Traits;

use App\Models\Bill;
use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int client_id;
 * @property-read Client $client;
 */
trait BelongsToClientTrait
{
    final public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}

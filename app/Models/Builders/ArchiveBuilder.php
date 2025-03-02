<?php

namespace App\Models\Builders;

use App\Models\Archive;
use Illuminate\Database\Eloquent\Builder;

/**@mixin Archive*/
class ArchiveBuilder extends BaseBuilder
{

    public function forClientOrDisabledClient(?int $client_id)
    {
        if (!$client_id)
            return $this;
        return $this->where(function (Builder $query) use ($client_id) {
            $query->where('client_id', $client_id)
                ->orWhere('disabled_client_id', $client_id);
        });
    }

}

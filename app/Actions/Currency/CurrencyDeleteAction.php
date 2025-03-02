<?php

namespace App\Actions\Currency;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Currency;

class CurrencyDeleteAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_CURRENCIES_DELETE;

    public function handle(Currency $currency)
    {
        $this->tryDelete($currency);
        return back();
    }
}

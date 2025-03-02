<?php

namespace App\Actions\Currency;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyUpdateAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_CURRENCIES_EDIT;

    public function handle(Currency $currency,CurrencyRequest $request)
    {
        $currency->update($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

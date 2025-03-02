<?php

namespace App\Actions\Currency;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyStoreAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_CURRENCIES_STORE;

    public function handle(CurrencyRequest $request)
    {
        Currency::create($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

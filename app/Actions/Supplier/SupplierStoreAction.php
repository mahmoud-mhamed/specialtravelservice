<?php

namespace App\Actions\Supplier;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;

class SupplierStoreAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_SUPPLIER_STORE;

    public function handle(SupplierRequest $request)
    {
        Supplier::create($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

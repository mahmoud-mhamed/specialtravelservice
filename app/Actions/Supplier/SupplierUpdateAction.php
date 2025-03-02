<?php

namespace App\Actions\Supplier;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;

class SupplierUpdateAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_SUPPLIER_EDIT;

    public function handle(Supplier $supplier,SupplierRequest $request)
    {
        $supplier->update($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

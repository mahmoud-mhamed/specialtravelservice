<?php

namespace App\Actions\Supplier;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Supplier;

class SupplierDeleteAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_SUPPLIER_DELETE;

    public function handle(Supplier $supplier)
    {
        $this->tryDelete($supplier);
        return back();
    }
}

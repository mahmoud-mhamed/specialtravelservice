<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Bill;

class BillDeleteAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_BILL_DELETE;

    public function handle(Bill $bill)
    {
        $this->tryDelete($bill);
        $this->makeSuccessSessionMessage();
        return back();
    }
}

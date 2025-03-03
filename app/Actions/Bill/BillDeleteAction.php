<?php

namespace App\Actions\Bill;

use App\Classes\BaseAction;
use App\Models\Bill;

class BillDeleteAction extends BaseAction
{
    public function handle(Bill $bill)
    {
        $this->tryDelete($bill);
        $this->makeSuccessSessionMessage();
        return back();
    }
}

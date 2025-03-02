<?php

namespace App\Actions\BillPayment;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillPaymentTypeEnum;
use App\Models\BillPayment;

class BillPaymentDeleteAction extends BaseAction
{
    public function handle(BillPayment $billPayment)
    {
        $this->checkAbility($billPayment->type == BillPaymentTypeEnum::TO_SUPPLIER ? Abilities::M_BILL_PAYMENT_DELETE_TO_SUPPLIER : Abilities::M_BILL_PAYMENT_DELETE_FROM_CLIENT);
        $this->tryDelete($billPayment);
        $this->makeSuccessSessionMessage();
        return back();
    }
}

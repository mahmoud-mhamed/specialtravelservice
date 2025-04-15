<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillStatusEnum;
use App\Models\Bill;

class VisitorPayBillAction extends BaseAction
{
//    protected Abilities $ability=Abilities::;

    public function handle(Bill $bill)
    {
        $data['bill'] = $bill;
        $this->pageTitle(__('message.pay_bill'));
        if ($bill->status == BillStatusEnum::PAID)
            return inertia('Visitor/BillPayed',compact('data'));

        return inertia('Visitor/BillPay',compact('data'));
    }
}

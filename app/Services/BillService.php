<?php

namespace App\Services;

use App\Enums\BillPaymentTypeEnum;
use App\Models\Bill;
use App\Models\BillPayment;

class BillService extends BaseService
{
    public function setBillPaidAmount(Bill $bill): void
    {
        $payments = BillPayment::query()->where('bill_payments.bill_id', $bill->id)->get();

        $sum_paid_supplier = $payments->where('type', BillPaymentTypeEnum::TO_SUPPLIER)->sum('bill_currency_equal_total');
        $sum_paid_customer = $payments->where('type', BillPaymentTypeEnum::FROM_CLIENT)->sum('bill_currency_equal_total');
        $bill->update([
            'supplier_paid_amount' => $sum_paid_supplier,
            'client_paid_amount' => $sum_paid_customer,
        ]);
    }
}

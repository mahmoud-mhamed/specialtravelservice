<?php

namespace App\Observers;

use App\Models\BillPayment;
use App\Services\BillService;

class BillPaymentObserver
{
    /**
     * Handle the BillPayment "created" event.
     */
    public function created(BillPayment $billPayment): void
    {
        BillService::make()->setBillPaidAmount($billPayment->bill);
    }

    /**
     * Handle the BillPayment "updated" event.
     */
    public function updated(BillPayment $billPayment): void
    {
        BillService::make()->setBillPaidAmount($billPayment->bill);
    }

    /**
     * Handle the BillPayment "deleted" event.
     */
    public function deleted(BillPayment $billPayment): void
    {
        BillService::make()->setBillPaidAmount($billPayment->bill);
    }

    /**
     * Handle the BillPayment "restored" event.
     */
    public function restored(BillPayment $billPayment): void
    {
        //
    }

    /**
     * Handle the BillPayment "force deleted" event.
     */
    public function forceDeleted(BillPayment $billPayment): void
    {
        //
    }
}

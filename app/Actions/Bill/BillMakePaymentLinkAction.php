<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillStatusEnum;
use App\Models\Bill;
use Illuminate\Support\Facades\Log;

class BillMakePaymentLinkAction extends BaseAction
{
    public function handle(Bill $bill)
    {
        abort_if($bill->payment_link, 404);

        $description = "مرحبا " . $bill->client_name . " - دفع رسوم خدمة " . $bill->service;
        $response = \App\Services\QNBService::make($bill->id.time(), $bill->price)->setDescription($description)->pay();
        Log::info('make payment link', [
            'bill_id' => $bill->id,
            'response' => $response
        ]);
        if (data_get($response, 'result') == 'ERROR') {
            $this->makeErrorSessionMessage(data_get($response, 'error.explanation'));
            return back();
        }
        $bill->update([
            'status' => BillStatusEnum::IN_PAY,
            'payment_link' => $response['paymentLink']['url'],
            'payment_link_data' => $response['paymentLink'],
        ]);
        $this->makeSuccessSessionMessage();
        return back();
    }
}

<?php

namespace App\Actions\Bill;

use App\Classes\BaseAction;
use App\Enums\BillStatusEnum;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;

class BillMarkPayedAction extends BaseAction
{
    public function handle(Bill $bill)
    {
        abort_if(Auth::id() != 1 || $bill->status != BillStatusEnum::IN_PAY, 404);
        $bill->update([
            'status' => BillStatusEnum::PAID
        ]);
        $this->makeSuccessSessionMessage();
        return back();
    }
}

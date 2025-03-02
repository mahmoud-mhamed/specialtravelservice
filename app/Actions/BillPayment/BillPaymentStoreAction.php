<?php

namespace App\Actions\BillPayment;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillPaymentTypeEnum;
use App\Http\Requests\BillPaymentRequest;
use App\Models\Archive;
use App\Models\Bill;
use App\Models\BillPayment;
use Illuminate\Validation\ValidationException;

class BillPaymentStoreAction extends BaseAction
{
    /**
     * @throws \Throwable
     */
    public function handle(Bill $bill, BillPaymentRequest $request)
    {
        $validated_data = $request->validated();
        $type = BillPaymentTypeEnum::from($validated_data['type']);
        $this->checkAbility('m_bill_payment_store_' . $type->value);

        $validated_data['bill_id'] = $bill->id;

        $rent = $type == BillPaymentTypeEnum::TO_SUPPLIER ? $bill->supplier_rent_amount : $bill->client_rent_amount;
        if ($rent < $validated_data['bill_currency_equal_total']) {
            throw ValidationException::withMessages([
                'bill_currency_equal_total' => __('validation-inline.lte.numeric', [
                    'attribute' => __('column.bill_currency_equal_total'), 'value' => $rent . ' ' . $bill->currency->code
                ])]);
        }
        \DB::beginTransaction();
        if (data_get($validated_data, 'proof_archive_id') && is_file($validated_data['proof_archive_id'])) {
            $new_data = [
                'collection_name' => 'proof_archive_id',
                'bill_id' => $bill->id,
            ];
            $archive = Archive::create([
                'name' => BillPaymentUpdateAction::make()->getProofArchiveFileName($type),
                'file' => $validated_data['proof_archive_id'],
                'client_id' => $bill->client_id,
                'disabled_client_id' => $bill->disabled_client_id,
                ...$new_data
            ]);
            $validated_data['proof_archive_id'] = $archive->id;
        }
        BillPayment::create($validated_data);
        \DB::commit();
        $this->makeSuccessSessionMessage();
        return back();
    }
}

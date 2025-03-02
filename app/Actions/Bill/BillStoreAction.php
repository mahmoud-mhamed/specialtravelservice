<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillPurchaseTypeEnum;
use App\Enums\BillStatusEnum;
use App\Http\Requests\BillRequest;
use App\Models\Archive;
use App\Models\Bill;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Supplier;

class BillStoreAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_BILL_CREATE;

    /**
     * @throws \Throwable
     */
    public function handle(BillRequest $request)
    {
        $validated_data = $request->validated();
        \DB::beginTransaction();
        $bill = Bill::create($validated_data);
        $this->handelFiles($bill,$validated_data);

        \DB::commit();
        $this->makeSuccessSessionMessage();
        return back();
    }

    public function handelFiles(Bill $bill,$validated_data): void
    {
        foreach (['client_national_id', 'disabled_client_national_id', 'disabled_client_envelope','smart_card'] as $item) {
            if (data_get($validated_data, $item) && is_file($validated_data[$item])) {
                $new_data=[
                    'collection_name' => $item,
                    'bill_id' => $bill->id,
                ];
                Archive::query()->where($new_data)->delete();
                Archive::create([
                    'file' => $validated_data[$item],
                    'client_id' => $bill->client_id,
                    'disabled_client_id' => $bill->disabled_client_id,
                    ...$new_data
                ]);
            }
        }
    }
    public function viewForm(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $this->checkAbility($this->ability);
        BillIndexAction::make()->useBreadcrumb([
            ['label' => __('message.add_new')],
        ]);
        $data = $this->getFormCreateUpdateData();
        return inertia('Bill/Create', compact('data'));
    }

    public function getFormCreateUpdateData(): array
    {
        return [
            'form_data' => [
                'status' => BillStatusEnum::getOptionsData(),
                'clients' => Client::query()->get(),
                'suppliers' => Supplier::query()->with('currency')->get(),
                'purchase_types' => BillPurchaseTypeEnum::getOptionsData(),
            ]
        ];
    }
}

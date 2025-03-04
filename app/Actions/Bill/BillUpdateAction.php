<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\BillRequest;
use App\Models\Bill;

class BillUpdateAction extends BaseAction
{
    /**
     * @throws \Throwable
     */
    public function handle(Bill $bill, BillRequest $request)
    {
        $validated_data = $request->validated();
        \DB::beginTransaction();

        $bill->update($validated_data);

        \DB::commit();
        $this->makeSuccessSessionMessage();
        return back();
    }

    public function viewForm(Bill $bill): \Inertia\Response|\Inertia\ResponseFactory
    {
        BillIndexAction::make()->useBreadcrumb([
            ['label' => '# ' . $bill->id . ' ' . __('message.edit')],
        ]);
        $data = BillStoreAction::make()->getFormCreateUpdateData();
        $data['row'] = $bill;
        return inertia('Bill/Create', compact('data'));
    }
}

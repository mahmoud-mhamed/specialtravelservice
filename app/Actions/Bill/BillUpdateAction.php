<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\BillRequest;
use App\Models\Bill;

class BillUpdateAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_BILL_EDIT;

    /**
     * @throws \Throwable
     */
    public function handle(Bill $bill, BillRequest $request)
    {
        $validated_data = $request->validated();
        \DB::beginTransaction();

        $bill->update($validated_data);
        BillStoreAction::make()->handelFiles($bill, $validated_data);

        \DB::commit();
        $this->makeSuccessSessionMessage();
        return back();
    }

    public function viewForm(Bill $bill): \Inertia\Response|\Inertia\ResponseFactory
    {
        $this->checkAbility($this->ability);

        BillIndexAction::make()->useBreadcrumb([
            ['label' => '# ' . $bill->id . ' ' . __('message.edit')],
        ]);
        $data = BillStoreAction::make()->getFormCreateUpdateData();
        foreach ($bill->archives as $archive) {
            $bill[$archive->collection_name->getValue() . '_url'] = $archive->file_url;
        }
        $data['row'] = $bill;
        return inertia('Bill/Create', compact('data'));
    }
}

<?php

namespace App\Actions\Bill;

use App\Classes\BaseAction;
use App\Http\Requests\BillRequest;
use App\Models\Bill;

class BillStoreAction extends BaseAction
{
    /**
     * @throws \Throwable
     */
    public function handle(BillRequest $request)
    {
        $validated_data = $request->validated();
        \DB::beginTransaction();
        $bill = Bill::create($validated_data);

        \DB::commit();
        $this->makeSuccessSessionMessage();
        return back();
    }

    public function viewForm(): \Inertia\Response|\Inertia\ResponseFactory
    {
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
            ]
        ];
    }
}

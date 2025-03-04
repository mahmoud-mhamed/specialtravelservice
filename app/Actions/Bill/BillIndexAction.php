<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Bill;
use Inertia\Inertia;

class BillIndexAction extends BaseAction
{
    public function handle()
    {
        $this->useBreadcrumb();
        $this->allowSearch();
        $query = Bill::query()
            ->filter()
            ->search(['client_name', 'service', 'notes','price']);

        $this->useFilter(Bill::query()->getFilters());
        $data['rows'] = $query->latest('id')->paginate();
        return Inertia::render('Bill/Index', compact('data'));
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::BILL), 'url' => route('dashboard.bill.index')],
            ...$append_breadcrumb
        ]);
    }

}

<?php

namespace App\Actions\Bill;

use App\Classes\BaseAction;
use App\Models\Bill;
use Inertia\Inertia;

class BillProfileAction extends BaseAction
{
    public function viewMainData(Bill $bill): \Inertia\Response
    {
        $this->setProfileTab('MainDataTab', $bill);
        $data['row'] = $bill;
        return Inertia::render('Bill/Profile/Index', compact('data'));
    }

    public function setProfileTab($tap_component, Bill &$row, $title = null): void
    {
        $main_data_url = ['label' => '#' . $row->id, 'url' => route('dashboard.bill.profile.main_data', $row)];

        if ($title) {
            BillIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            BillIndexAction::make()->useBreadcrumb([$main_data_url]);
        }
        $this->useTransparent();

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }

    public function getFormCreateUpdatePayment(Bill $bill): array
    {
        return [
            'form_data' => [
                'bill_id' => $bill->id,
            ],
        ];
    }
}

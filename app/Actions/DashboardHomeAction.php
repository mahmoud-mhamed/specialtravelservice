<?php

namespace App\Actions;

use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Bill;
use App\Models\User;
use Inertia\Inertia;

class DashboardHomeAction extends BaseAction
{
    public function handle()
    {
        $this->pageTitle(__('message.home'));
        $this->useTransparent();

        $data['users'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::USERS),
            User::query()->count(),
            'pi-users'
        );
        $data['bills'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::BILL),
            Bill::query()->count(),
            'pi-receipt'
        );
        return Inertia::render('Home', compact('data'));
    }
}

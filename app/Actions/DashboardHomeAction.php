<?php

namespace App\Actions;

use App\Chart\Client\ClientInCurrentYearBarChart;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Supplier;
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
        $data['clients'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::CLIENT),
            Client::query()->count(),
            'pi-users'
        );

        $data['currencies'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::CURRENCIES),
            Currency::query()->count(),
            'pi-dollar'
        );
        $data['suppliers'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::SUPPLIER),
            Supplier::query()->count(),
            'pi-users'
        );

        $data['ClientInCurrentYearBarChart']=ClientInCurrentYearBarChart::make()->toVue();
        return Inertia::render('Home', compact('data'));
    }
}

<?php

namespace App\Actions;

use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
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

        return Inertia::render('Home', compact('data'));
    }
}

<?php

namespace App\Classes;

use App\Enums\ModuleNameEnum;
use App\Services\BouncerService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Menu
{
    public function getMenu(): array
    {
        $current_route_name = Route::currentRouteName();
        $response[] = ['label' => __('message.home'), 'icon' => 'pi-home',
            'href' => \route('dashboard.home'),
            'active' => $current_route_name == 'home'
        ];

        if (BouncerService::checkAbility(Abilities::M_USERS_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::USERS->value), 'icon' => 'pi-users',
                'href' => \route('dashboard.users.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.users.') || Str::startsWith($current_route_name, 'dashboard.roles.')
            ];


        $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::BILL->value), 'icon' => 'pi-receipt',
            'href' => \route('dashboard.bill.index'),
            'active' => Str::startsWith($current_route_name, 'dashboard.bill.')
        ];
        return $response;
    }


}

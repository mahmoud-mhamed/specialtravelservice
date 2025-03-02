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


        if (BouncerService::checkAbility(Abilities::M_CURRENCIES_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::CURRENCIES->value), 'icon' => 'pi-dollar',
                'href' => \route('dashboard.currency.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.currency.')
            ];

        if (BouncerService::checkAbility(Abilities::M_CLIENT_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::CLIENT->value), 'icon' => 'pi-users',
                'href' => \route('dashboard.client.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.client.')
            ];

        if (BouncerService::checkAbility(Abilities::M_SUPPLIER_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SUPPLIER->value), 'icon' => 'pi-users',
                'href' => \route('dashboard.supplier.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.supplier.')
            ];

        if (BouncerService::checkAbility(Abilities::M_BILL_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::BILL->value), 'icon' => 'pi-receipt',
                'href' => \route('dashboard.bill.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.bill.')
            ];
        return $response;
    }



}

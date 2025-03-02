<?php

namespace App\Classes;

use App\Enums\ModuleNameEnum;
use App\Traits\EnumOptionsTrait;

enum Abilities: string
{
    use EnumOptionsTrait;

    case M_USERS_INDEX = 'm_users_index';
    case M_USERS_INDEX_EXPORT = 'm_users_index_export';
    case M_USERS_STORE = 'm_users_store';
    case M_USERS_UPDATE = 'm_users_update';
    case M_USERS_DELETE = 'm_users_delete';
    case M_USERS_MAIN_DATA = 'm_users_main_data';
    case M_USERS_ADD_CUSTOM_ABILITY = 'm_users_add_custom_ability';
    // Roles
    case M_ROLES_INDEX = 'm_roles_index';
    case M_ROLES_STORE = 'm_roles_store';
    case M_ROLES_EDIT = 'm_roles_edit';
    case M_ROLES_DELETE = 'm_roles_delete';
    case M_ROLES_INDEX_EXPORT = 'm_roles_index_export';

    // currencies
    case M_CURRENCIES_INDEX = 'm_currencies_index';
    case M_CURRENCIES_STORE = 'm_currencies_store';
    case M_CURRENCIES_EDIT = 'm_currencies_edit';
    case M_CURRENCIES_DELETE = 'm_currencies_delete';

    // suppliers
    case M_SUPPLIER_INDEX = 'm_supplier_index';
    case M_SUPPLIER_STORE = 'm_supplier_store';
    case M_SUPPLIER_EDIT = 'm_supplier_edit';
    case M_SUPPLIER_DELETE = 'm_supplier_delete';


    // clients
    case M_CLIENT_INDEX = 'm_client_index';
    case M_CLIENT_STORE = 'm_client_store';
    case M_CLIENT_EDIT = 'm_client_edit';
    case M_CLIENT_DELETE = 'm_client_delete';
    case M_CLIENT_PROFILE = 'm_client_profile';
    case M_CLIENT_BILLS = 'm_client_bills';
    case M_CLIENT_ARCHIVE = 'm_client_archive';


    //bill
    case M_BILL_INDEX = 'm_bill_index';
    case M_BILL_CREATE = 'm_bill_create';
    case M_BILL_EDIT = 'm_bill_edit';
    case M_BILL_DELETE = 'm_bill_delete';
    case M_BILL_PROFILE = 'm_bill_profile';
    case M_BILL_ARCHIVE = 'm_bill_archive';
    case M_BILL_VIEW_PAYMENT_SUPPLIER = 'm_bill_view_payment_supplier';
    case M_BILL_VIEW_PAYMENT_CLIENT = 'm_bill_view_payment_client';


    case M_BILL_PAYMENT_STORE_TO_SUPPLIER = 'm_bill_payment_store_to_supplier';
    case M_BILL_PAYMENT_UPDATE_TO_SUPPLIER = 'm_bill_payment_update_to_supplier';
    case M_BILL_PAYMENT_DELETE_TO_SUPPLIER = 'm_bill_payment_delete_to_supplier';

    case M_BILL_PAYMENT_STORE_FROM_CLIENT = 'm_bill_payment_store_from_client';
    case M_BILL_PAYMENT_UPDATE_FROM_CLIENT = 'm_bill_payment_update_from_client';
    case M_BILL_PAYMENT_DELETE_FROM_CLIENT = 'm_bill_payment_delete_from_client';

    public const PERMISSIONS = [
        ['key' => self::M_USERS_INDEX, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_INDEX_EXPORT, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_STORE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_UPDATE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_MAIN_DATA, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_DELETE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_ADD_CUSTOM_ABILITY, 'module' => ModuleNameEnum::USERS],

        ['key' => self::M_ROLES_INDEX, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_INDEX_EXPORT, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_EDIT, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_STORE, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_DELETE, 'module' => ModuleNameEnum::ROLES],

        ['key' => self::M_CURRENCIES_INDEX, 'module' => ModuleNameEnum::CURRENCIES],
        ['key' => self::M_CURRENCIES_EDIT, 'module' => ModuleNameEnum::CURRENCIES],
        ['key' => self::M_CURRENCIES_STORE, 'module' => ModuleNameEnum::CURRENCIES],
        ['key' => self::M_CURRENCIES_DELETE, 'module' => ModuleNameEnum::CURRENCIES],


        ['key' => self::M_SUPPLIER_INDEX, 'module' => ModuleNameEnum::SUPPLIER],
        ['key' => self::M_SUPPLIER_EDIT, 'module' => ModuleNameEnum::SUPPLIER],
        ['key' => self::M_SUPPLIER_STORE, 'module' => ModuleNameEnum::SUPPLIER],
        ['key' => self::M_SUPPLIER_DELETE, 'module' => ModuleNameEnum::SUPPLIER],


        ['key' => self::M_CLIENT_INDEX, 'module' => ModuleNameEnum::CLIENT],
        ['key' => self::M_CLIENT_EDIT, 'module' => ModuleNameEnum::CLIENT],
        ['key' => self::M_CLIENT_STORE, 'module' => ModuleNameEnum::CLIENT],
        ['key' => self::M_CLIENT_DELETE, 'module' => ModuleNameEnum::CLIENT],
        ['key' => self::M_CLIENT_PROFILE, 'module' => ModuleNameEnum::CLIENT],
        ['key' => self::M_CLIENT_BILLS, 'module' => ModuleNameEnum::CLIENT],
        ['key' => self::M_CLIENT_ARCHIVE, 'module' => ModuleNameEnum::CLIENT],

        ['key' => self::M_BILL_INDEX, 'module' => ModuleNameEnum::BILL],
        ['key' => self::M_BILL_CREATE, 'module' => ModuleNameEnum::BILL],
        ['key' => self::M_BILL_EDIT, 'module' => ModuleNameEnum::BILL],
        ['key' => self::M_BILL_DELETE, 'module' => ModuleNameEnum::BILL],
        ['key' => self::M_BILL_PROFILE, 'module' => ModuleNameEnum::BILL],
        ['key' => self::M_BILL_ARCHIVE, 'module' => ModuleNameEnum::BILL],
        ['key' => self::M_BILL_VIEW_PAYMENT_SUPPLIER, 'module' => ModuleNameEnum::BILL],
        ['key' => self::M_BILL_VIEW_PAYMENT_CLIENT, 'module' => ModuleNameEnum::BILL],


        ['key' => self::M_BILL_PAYMENT_STORE_TO_SUPPLIER, 'module' => ModuleNameEnum::BILL_PAYMENT],
        ['key' => self::M_BILL_PAYMENT_UPDATE_TO_SUPPLIER, 'module' => ModuleNameEnum::BILL_PAYMENT],
        ['key' => self::M_BILL_PAYMENT_DELETE_TO_SUPPLIER, 'module' => ModuleNameEnum::BILL_PAYMENT],
        ['key' => self::M_BILL_PAYMENT_STORE_FROM_CLIENT, 'module' => ModuleNameEnum::BILL_PAYMENT],
        ['key' => self::M_BILL_PAYMENT_UPDATE_FROM_CLIENT, 'module' => ModuleNameEnum::BILL_PAYMENT],
        ['key' => self::M_BILL_PAYMENT_DELETE_FROM_CLIENT, 'module' => ModuleNameEnum::BILL_PAYMENT],

    ];

    public static function getModulePermission(ModuleNameEnum $moduleNameEnum): \Illuminate\Support\Collection
    {
        return collect(self::PERMISSIONS)->where('module', $moduleNameEnum);
    }

    /*get abilities by name*/
    public static function getAbilities(): \Illuminate\Support\Collection
    {
        $items = collect(self::PERMISSIONS);
        $response = collect();
        foreach ($items as $item) {
            $response->push([
                'module' => $item['module'],
                'alias' => $item['alias'] ?? $item['module'],
                'key' => $item['key']->value
            ]);
        }
        return $response;
    }

    /*get abilities by name*/
    public static function getAbilitiesGroupByModule(): \Illuminate\Support\Collection
    {
        return self::getAbilities()->groupBy('module');
    }

}

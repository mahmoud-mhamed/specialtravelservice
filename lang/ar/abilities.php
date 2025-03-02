<?php

$index = 'عرض';
$create = 'إضافة';
$update = 'تعديل';
$delete = 'حذف';
$viewProfile = 'البيانات الأساسية';
$toggleActive = 'حالة التفعيل';
$toggleDefault = 'حالة الافتراض';
$import = 'استيراد اكسل';
$export = 'التصدير اكسل';
$viewUsers = 'مشاهدة المستخدمين';
$sort = 'الترتيب';
$notify = 'تنبيه';
$report = 'تقرير';
$show = 'عرض البيانات';
$sendNotification = 'إرسال إشعار';
$add_custom_ability = 'إضافة صلاحيات مخصصه';

use App\Classes\Abilities;

return [
    Abilities::M_USERS_INDEX->value => $index,
    Abilities::M_USERS_INDEX_EXPORT->value => $export,
    Abilities::M_USERS_MAIN_DATA->value => $viewProfile,
    Abilities::M_USERS_DELETE->value => $delete,
    Abilities::M_USERS_UPDATE->value => $update,
    Abilities::M_USERS_STORE->value => $create,
    Abilities::M_USERS_ADD_CUSTOM_ABILITY->value => $add_custom_ability,

    Abilities::M_ROLES_INDEX->value => $index,
    Abilities::M_ROLES_STORE->value => $create,
    Abilities::M_ROLES_EDIT->value => $update,
    Abilities::M_ROLES_DELETE->value => $delete,
    Abilities::M_ROLES_INDEX_EXPORT->value => $export,


    Abilities::M_CURRENCIES_INDEX->value => $index,
    Abilities::M_CURRENCIES_STORE->value => $create,
    Abilities::M_CURRENCIES_EDIT->value => $update,
    Abilities::M_CURRENCIES_DELETE->value => $delete,

    Abilities::M_SUPPLIER_INDEX->value => $index,
    Abilities::M_SUPPLIER_STORE->value => $create,
    Abilities::M_SUPPLIER_EDIT->value => $update,
    Abilities::M_SUPPLIER_DELETE->value => $delete,

    Abilities::M_CLIENT_INDEX->value => $index,
    Abilities::M_CLIENT_STORE->value => $create,
    Abilities::M_CLIENT_EDIT->value => $update,
    Abilities::M_CLIENT_DELETE->value => $delete,
    Abilities::M_CLIENT_PROFILE->value => $viewProfile,
    Abilities::M_CLIENT_BILLS->value => 'عرض الفواتير',
    Abilities::M_CLIENT_ARCHIVE->value => 'عرض الأرشيف',

    Abilities::M_BILL_INDEX->value => $index,
    Abilities::M_BILL_CREATE->value => $create,
    Abilities::M_BILL_EDIT->value => $update,
    Abilities::M_BILL_DELETE->value => $delete,
    Abilities::M_BILL_PROFILE->value => $viewProfile,
    Abilities::M_BILL_ARCHIVE->value => 'عرض الأرشيف',
    Abilities::M_BILL_VIEW_PAYMENT_SUPPLIER->value => 'عرض دفعات المورد',
    Abilities::M_BILL_VIEW_PAYMENT_CLIENT->value => 'عرض دفعات العميل',

    Abilities::M_BILL_PAYMENT_STORE_TO_SUPPLIER->value => 'إضافة دفعة للمورد',
    Abilities::M_BILL_PAYMENT_UPDATE_TO_SUPPLIER->value => 'تعديل دفعة للمورد',
    Abilities::M_BILL_PAYMENT_DELETE_TO_SUPPLIER->value => 'حذف دفعة للمورد',
    Abilities::M_BILL_PAYMENT_STORE_FROM_CLIENT->value => 'إضافة دفعة للعميل',
    Abilities::M_BILL_PAYMENT_UPDATE_FROM_CLIENT->value => 'تعديل دفعة للعميل',
    Abilities::M_BILL_PAYMENT_DELETE_FROM_CLIENT->value => 'حذف دفعة للعميل',

];

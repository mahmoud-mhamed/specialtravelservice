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

    Abilities::M_BILL_INDEX->value => $index,
];

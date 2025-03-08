<?php

$index = 'View';
$create = 'Add';
$update = 'Edit';
$delete = 'Delete';
$viewProfile = 'Basic Information';
$toggleActive = 'Activation Status';
$toggleDefault = 'Default Status';
$import = 'Import Excel';
$export = 'Export Excel';
$viewUsers = 'View Users';
$sort = 'Sort';
$notify = 'Notify';
$report = 'Report';
$show = 'View Data';
$sendNotification = 'Send Notification';
$add_custom_ability = 'Add Custom Permissions';

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

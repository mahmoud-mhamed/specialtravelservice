<?php
return [
    //default config
    'multiple' => false,
    'disk' => env('FILE_UPLOAD_DEFAULT_DISK', 'public'),
    'path' => null,
    'on_update_not_null' => true,
    'on_change_delete_old_file' => true,
    'auto_delete' => true,
    'default_asset' => true,



];
/*protected array $fileupload = [
//        'avatar',
    'avatar'=>[
        'multiple'=>false,
        'disk'=>'public',
        'path'=>'/avatar',
        'on_update_not_null'=>true,
        'on_change_delete_old_file'=>true,
        'auto_delete'=>true,
//            'default_asset'=>null,
        'default_asset'=>"default_image/avatar.png",
    ],
];*/

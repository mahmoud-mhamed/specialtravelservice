<?php

return [
    'ModuleNameEnum' => [
        \App\Enums\ModuleNameEnum::USERS->value => 'المستخدمين',
        \App\Enums\ModuleNameEnum::BILL->value => 'الفواتير',
    ],
    \App\Enums\BillStatusEnum::getFileName()=>[
        \App\Enums\BillStatusEnum::PENDING->value => 'قيد الإنتظار',
        \App\Enums\BillStatusEnum::PAID->value => 'تم الدفع',
        \App\Enums\BillStatusEnum::IN_PAY->value => 'في إنتظار الدفع',
    ],
];

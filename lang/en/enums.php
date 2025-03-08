<?php

return [
    'ModuleNameEnum' => [
        \App\Enums\ModuleNameEnum::USERS->value => 'Users',
        \App\Enums\ModuleNameEnum::BILL->value => 'Bills',
    ],
    \App\Enums\BillStatusEnum::getFileName()=>[
        \App\Enums\BillStatusEnum::PENDING->value => 'Pending',
        \App\Enums\BillStatusEnum::PAID->value => 'Paid',
        \App\Enums\BillStatusEnum::IN_PAY->value => 'Waite For Pay',
    ],
];

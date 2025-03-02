<?php

use App\Enums\ArchiveCollectionNameEnum;
use App\Enums\BillPurchaseTypeEnum;

return [
    'ModuleNameEnum' => [
        \App\Enums\ModuleNameEnum::USERS->value => 'المستخدمين',
        \App\Enums\ModuleNameEnum::ROLES->value => 'الأدوار',
        \App\Enums\ModuleNameEnum::CURRENCIES->value => 'العملات',
        \App\Enums\ModuleNameEnum::SUPPLIER->value => 'الموردين',
        \App\Enums\ModuleNameEnum::CLIENT->value => 'العملاء',
        \App\Enums\ModuleNameEnum::BILL->value => 'الفواتير',
        \App\Enums\ModuleNameEnum::BILL_PAYMENT->value => 'دفعات الفواتير',
    ],
    \App\Enums\BillStatusEnum::getFileName()=>[
        \App\Enums\BillStatusEnum::PENDING->value => 'قيد الإنتظار',
        \App\Enums\BillStatusEnum::PURCHASED->value => 'تم الشراء',
        \App\Enums\BillStatusEnum::SHIPPED->value => 'تم الشحن',
        \App\Enums\BillStatusEnum::IN_CUSTOMS->value => 'في الجمرك',
        \App\Enums\BillStatusEnum::DELIVERED->value => 'تم التسليم',
        \App\Enums\BillStatusEnum::CANCELED->value => 'تم الإلغاء',
    ],
    \App\Enums\BillPurchaseTypeEnum::getFileName()=>[
        BillPurchaseTypeEnum::INITIATIVE->value => 'مبادرة',
        BillPurchaseTypeEnum::DISABILITY_ANSWER->value => 'جواب إعاقة',
        BillPurchaseTypeEnum::PERSONAL->value => 'شخصي',
    ],
    \App\Enums\ArchiveCollectionNameEnum::getFileName()=>[
        ArchiveCollectionNameEnum::DISABLED_CLIENT_NATIONAL_ID->value => 'صورة البطاقة الشخصية للمعاق',
        ArchiveCollectionNameEnum::CLIENT_NATIONAL_ID->value => 'صورة البطاقة الشخصية للعميل',
        ArchiveCollectionNameEnum::SMART_CARD->value => 'الكارت الذكي',
        ArchiveCollectionNameEnum::DISABLED_CLIENT_ENVELOPE->value => 'الجواب',
        ArchiveCollectionNameEnum::PROOF_ARCHIVE_ID->value => 'إثبات دفع',
    ],
    \App\Enums\BillPaymentTypeEnum::getFileName()=>[
        \App\Enums\BillPaymentTypeEnum::FROM_CLIENT->value => 'من العميل',
        \App\Enums\BillPaymentTypeEnum::TO_SUPPLIER->value => 'إلي المورد',
    ],
];

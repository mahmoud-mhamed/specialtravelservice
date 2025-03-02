<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ArchiveCollectionNameEnum: string
{
    use EnumOptionsTrait;

    case DISABLED_CLIENT_NATIONAL_ID = 'disabled_client_national_id';
    case DISABLED_CLIENT_ENVELOPE = 'disabled_client_envelope';
    case CLIENT_NATIONAL_ID = 'client_national_id';
    case SMART_CARD = 'smart_card';
    case PROOF_ARCHIVE_ID = 'proof_archive_id';
}

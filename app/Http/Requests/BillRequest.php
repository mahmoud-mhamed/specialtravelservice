<?php

namespace App\Http\Requests;

use App\Enums\BillPurchaseTypeEnum;
use App\Enums\BillStatusEnum;
use App\Rules\ArchiveFileRule;
use App\Rules\AvatarRule;
use App\Rules\DateFormatCreatedAtRule;
use App\Rules\LargeTextRule;
use App\Rules\PriceRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BillRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'client_id' => ['required', 'exists:clients,id'],
            'disabled_client_id' => ['nullable', 'exists:clients,id'],
            'purchase_price' => ['required', new PriceRule()],
            'purchase_type' => ['required', new Enum(BillPurchaseTypeEnum::class)],
            'selling_price' => ['required', new PriceRule()],
            'purchase_date' => ['required', new DateFormatCreatedAtRule()],
            'chassis_number' => ['required', new SmallTextRule()],
            'status' => ['required', new Enum(BillStatusEnum::class)],
            'car_type' => ['required', new SmallTextRule()],
            'shipping_type' => ['nullable', new SmallTextRule()],
            'shipping_date' => ['nullable', new DateFormatCreatedAtRule()],
            'shipping_amount' => ['nullable',new PriceRule()],
            'policy_number' => ['nullable',new SmallTextRule()],
            'notes' => ['nullable',new LargeTextRule()],
            'client_national_id' => ['nullable',new AvatarRule()],
            'disabled_client_national_id' => ['nullable',new AvatarRule()],
            'disabled_client_envelope' => ['nullable',new AvatarRule()],
            'smart_card' => ['nullable',new ArchiveFileRule()],
        ];
    }
}

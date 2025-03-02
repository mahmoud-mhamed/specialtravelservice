<?php

namespace App\Http\Requests;

use App\Enums\BillPaymentTypeEnum;
use App\Rules\ArchiveFileRule;
use App\Rules\DateFormatCreatedAtRule;
use App\Rules\LargeTextRule;
use App\Rules\PriceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class BillPaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'paid_amount' => [
                'required', new PriceRule(),
            ],
            'paid_currency_id' => [
                'required', Rule::exists('currencies', 'id'),
            ],
            'bill_currency_equal_value' => [
                'required', new PriceRule(),
            ],
            'bill_currency_equal_total' => [
                'required', new PriceRule(),
            ],
            'type' => [
                'required',new Enum(BillPaymentTypeEnum::class),
            ],
            'note' => [
                'nullable',new LargeTextRule(),
            ],
            'payment_date' => [
                'required', new DateFormatCreatedAtRule(),
            ],
            'proof_archive_id' => [
                'nullable', new ArchiveFileRule()
            ]
        ];
    }
}

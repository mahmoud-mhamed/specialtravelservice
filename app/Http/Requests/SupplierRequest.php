<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberRule;
use App\Rules\PriceRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            'name' => [
                'required', new SmallTextRule(),
                Rule::unique('suppliers', 'name')->where('deleted_at', null)->ignore($request->supplier?->id),
            ],
            'country'=>[
                'nullable',new SmallTextRule(),
            ],
            'phone' => [
                'nullable', new PhoneNumberRule(),
                Rule::unique('suppliers', 'phone')->where('deleted_at', null)->ignore($request->supplier?->id),
            ],
            'currency_id' => [
                'required', Rule::exists('currencies', 'id'),
            ],
        ];
    }
}

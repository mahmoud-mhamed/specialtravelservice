<?php

namespace App\Http\Requests;

use App\Rules\PriceRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'client_name' => ['required', new SmallTextRule()],
            'service' => ['required', new SmallTextRule()],
            'notes' => ['nullable', new SmallTextRule()],
            'price' => ['required', new PriceRule()],
        ];
    }
}

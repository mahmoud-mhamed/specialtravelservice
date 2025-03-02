<?php

namespace App\Http\Requests;

use App\Models\Currency;
use App\Rules\PriceRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            'name'=>[
                'required',
                new SmallTextRule(),Rule::unique(Currency::class,'name')
                    ->where('deleted_at',null)->ignore($request->currency?->id)
            ],
            'code'=>[
                'required',
                new SmallTextRule(),Rule::unique(Currency::class,'code')
                    ->where('deleted_at',null)->ignore($request->currency?->id)
            ],
        ];
    }
}

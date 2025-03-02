<?php

namespace App\Http\Requests;

use App\Classes\Abilities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RolesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'abilities' => ['required', 'array','min:1','distinct'],
            'abilities.*' => ['required',Rule::in(collect(Abilities::PERMISSIONS)->pluck('key.value')->toArray())]
        ];
    }
}

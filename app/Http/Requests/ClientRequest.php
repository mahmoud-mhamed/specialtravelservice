<?php

namespace App\Http\Requests;

use App\Rules\AvatarRule;
use App\Rules\NationalIdRule;
use App\Rules\PhoneNumberRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $required_in_create = $this->client?->id ? 'nullable' : 'required';
        return [
            'name' => ['required', new SmallTextRule()],
            'phone' => ['required', new PhoneNumberRule()],
            'national_id' => [
                'required', new NationalIdRule(),
                Rule::unique('clients', 'national_id')->where('deleted_at', null)->ignore($this->client?->id),
            ],
            'note' => ['nullable', new SmallTextRule()],
            'national_id_img_front' => ['nullable', new AvatarRule()],
            'national_id_img_back' => ['nullable', new AvatarRule()],
        ];
    }
}

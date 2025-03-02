<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\AvatarRule;
use App\Rules\EmailRule;
use App\Rules\PasswordRule;
use App\Rules\PhoneNumberRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request): array
    {
        $is_create = !$request->user?->id;
        return [
            'name' => ['required', new SmallTextRule()],
            'email' => [
                'required',
                Rule::unique(User::class, 'email')->whereNull('deleted_at')->ignore($request->user?->id),
                new EmailRule()
            ],
            'phone' => [
                'nullable',
                Rule::unique(User::class, 'phone')->whereNull('deleted_at')->ignore($request->user?->id),
                new PhoneNumberRule()
            ],
            'password' => [$is_create ? 'required' : 'nullable', new PasswordRule()],
            'avatar' => [
                'nullable', new AvatarRule()
            ],
            'is_active' => "required|boolean",
            'role' => Rule::exists('roles', 'name'),
        ];
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = preg_match("/^(010|011|012|015)\d{8}$/", $value);

        if (!$validator) {
            $fail( __('validation.phone'));
        }
    }
}

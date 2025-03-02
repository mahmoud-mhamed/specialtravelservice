<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class LongitudeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (!is_numeric($value) || $value < -180 || $value > 180) {
            $fail(__('validation.between.numeric', ['min' => -180, 'max' => 180]));
        }
    }
}

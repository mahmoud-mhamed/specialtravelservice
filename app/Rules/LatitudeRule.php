<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class LatitudeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (!is_numeric($value) || $value < -90 || $value > 90) {
            $fail(__('validation.between.numeric', ['min' => -90, 'max' => 90]));
        }
    }
}

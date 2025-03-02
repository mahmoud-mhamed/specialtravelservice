<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

class LargeTextRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validate = Validator::make([$attribute => $value], [
            $attribute => "max:1000",
        ]);

        if ($validate->fails()) {
            $fail(data_get($validate->messages()->toArray()[$attribute], 0));
        }
    }
}

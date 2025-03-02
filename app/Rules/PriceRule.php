<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class PriceRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validate = Validator::make([$attribute => $value], [
            $attribute => "numeric",
        ]);

        if ($validate->fails()) {
            $fail(data_get($validate->messages()->toArray()[$attribute], 0));
        }
    }
}

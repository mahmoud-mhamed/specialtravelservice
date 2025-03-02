<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class ArchiveFileRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validate = Validator::make([$attribute => $value], [
            $attribute => "file|max:500000",
        ]);

        if ($validate->fails()) {
            $fail(data_get($validate->messages()->toArray()[$attribute], 0));
        }
    }
}

<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AdultValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Carbon::now()->diffInYears(Carbon::parse($value)) < config('application.adult_age')){
            $fail("You must be older than ". config('application.adult_age'). "years to use application in your county.");
        }
    }
}

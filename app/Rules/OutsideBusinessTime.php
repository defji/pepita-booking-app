<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OutsideBusinessTime implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $hour = (int)Carbon::parse($value)->format("H");
        $day = (int)Carbon::parse($value)->format("w");
        $businessDays = config('app.business_time.days');
        $businessHourStart = config('app.business_time.hours')[0];
        $businessHourEnd = config('app.business_time.hours')[1];
        if ($hour < $businessHourStart || $hour > $businessHourEnd || !in_array($day, $businessDays)) {
            $fail("The selected date or time is outside than business hoours/days!");
        }
    }
}

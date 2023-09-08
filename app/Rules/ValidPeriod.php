<?php

namespace App\Rules;

use App\Models\Event;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPeriod implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $start = Carbon::parse(request('start'));
        $end = Carbon::parse(request('end'));
        $overlapExists = Event::where(function ($query) use ($start, $end) {
            $query->where(function ($query) use ($start, $end) {
                $query->where('start', '>=', $start)
                    ->where('start', '<=', $end);
            })
                ->orWhere(function ($query) use ($start, $end) {
                    $query->where('end', '>=', $start)
                        ->where('end', '<=', $end);
                })
                ->orWhere(function ($query) use ($start, $end) {
                    $query->where('start', '<', $start)
                        ->where('end', '>', $end);
                });
        })->exists();
        if ($overlapExists) {
            $fail('This date and time range is already taken!');
        }
    }
}

<?php

namespace App\Rules;

use App\Models\Event;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use RRule\RRule;
use RRule\RSet;

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

        $rruleStrings = Event::whereNotNull('rrule')->pluck('rrule');
        foreach ($rruleStrings as $rruleString) {
            $rrule = new RRule($rruleString);
            $occurrences = $rrule->getOccurrencesBetween($start, $end);
            if (count($occurrences)) {
                $fail('This date and time range is already taken with recurring events!');
            }
        }
    }
}

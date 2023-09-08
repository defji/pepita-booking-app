<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        - 2023-09-08-án 8-10 óra
        Event::create([
            'title' => fake()->company(),
            'start' => '2023-09-08 08:00:00',
            'end'   => '2023-09-08 10:00:00',
        ]);


        //       - 2023-01-01-től minden páros héten hétfőn 10-12 óra
//        - 2023-01-01-től minden páratlan héten szerda 12-16 óra
        $start = Carbon::parse("2023-01-01");
        do {
            $date = Carbon::parse($date ?? $start)->addDay(1);
            $weekNo = $date->format("W");
            if ($weekNo % 2 === 0 && $date->isMonday()) {
                Event::create([
                    'title' => fake()->company(),
                    'start' => $date->format("Y-m-d'").' 10:00:00',
                    'end'   => $date->format("Y-m-d'").' 12:00:00',
                ]);
            }
            if ($weekNo % 2 != 0 && $date->isWednesday()) {
                Event::create([
                    'title' => fake()->company(),
                    'start' => $date->format("Y-m-d'").' 12:00:00',
                    'end'   => $date->format("Y-m-d'").' 16:00:00',
                ]);
            }

            //   -2023-01-01 - től minden héten pénteken 10 - 16 óra
            if ($date->isFriday()) {
                Event::create([
                    'title' => fake()->company(),
                    'start' => $date->format("Y-m-d'").' 10:00:00',
                    'end'   => $date->format("Y-m-d'").' 16:00:00',
                ]);
            }

        } while (Carbon::parse($date)->format("Y-m-d") < "2033-12-31");


        //- 2023-06-01 - től 2023-11-30 - ig minden héten csütörtökön 16 - 20 óra
        unset($start, $date);
        $start = Carbon::parse("2023-06-01");
        do {
            $date = Carbon::parse($date ?? $start)->addDay(1);
            if ($date->isThursday()) {
                Event::create([
                    'title' => fake()->company(),
                    'start' => $date->format("Y-m-d'").' 16:00:00',
                    'end'   => $date->format("Y-m-d'").' 20:00:00',
                ]);
            }
        } while (Carbon::parse($date)->format("Y-m-d") < "2023-11-30");
    }
}

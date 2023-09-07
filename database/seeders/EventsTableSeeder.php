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
        Event::create([
            'title' => fake()->company(),
            'start' => '2023-09-08 08:00:00',
            'end'   => '2023-09-08 10:00:00',
        ]);

        $start = Carbon::parse("2023-09-01");
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
        } while (Carbon::parse($date)->format("Y-m-d") < "2033-12-31");

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

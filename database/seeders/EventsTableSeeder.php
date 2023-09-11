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

//    - 2023-01-01-től minden páros héten hétfőn 10-12 óra

        Event::create([
            'title' => fake()->company(),
            'rrule' => "DTSTART:20230101T103000Z\nRRULE:FREQ=WEEKLY;INTERVAL=2;BYDAY=MO;BYHOUR=10,11",

        ]);
//
//    - 2023-01-01-től minden páratlan héten szerda 12-16 óra
        Event::create([
            'title' => fake()->company(),
            'rrule' => "DTSTART:20230104T120000\nRRULE:FREQ=WEEKLY;INTERVAL=2;BYDAY=WE;BYHOUR=12,13,14,15",
        ]);
//
//
//    - 2023-01-01-től minden héten pénteken 10-16 óra
        Event::create([
            'title' => fake()->company(),
            'rrule' => "DTSTART:20230106T100000\nRRULE:FREQ=WEEKLY;BYDAY=FR;BYHOUR=10,11,12,13,14,15",
        ]);

//    - 2023-06-01-től 2023-11-30-ig minden héten csütörtökön 16-20 óra
        Event::create([
            'title' => fake()->company(),
            'rrule' => "DTSTART:20230601T160000\nRRULE:FREQ=WEEKLY;BYDAY=TH;INTERVAL=1;UNTIL=20231130T000000",
        ]);
    }
}

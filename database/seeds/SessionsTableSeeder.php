<?php

use Illuminate\Database\Seeder;
use Gym\Model\Session;
use Gym\Helper\MyDate;
use Carbon\Carbon;

class SessionsTableSeeder extends Seeder
{

    public function run()
    {
        $activity = ['Bike','Running','Dance','Fight','Jump','Spin','Lifting'];
        for ($dayOffset = 0; $dayOffset < 7; $dayOffset++) {
            for ($hourOffset = 0; $hourOffset < 15; $hourOffset++) {
                $hour = 7 + $hourOffset;
                DB::table('sessions')->insert([
                    'name' => "{$activity[$dayOffset]} {$hour}:00-{$hour}:30",
                    'start_at_date' => MyDate::dayOfCurrentWeek($dayOffset)->toDateString(),
                    'start_at_time' => Carbon::now()->setTime($hour,0,0)->toTimeString(),
                    'end_at_time' => Carbon::now()->setTime($hour,30,0)->toTimeString(),
                    'capacity' => 10,
                ]);
            }
        }
        for ($dayOffset = 0; $dayOffset < 7; $dayOffset++) {
            for ($hourOffset = 0; $hourOffset < 15; $hourOffset += 4) {
                $hour = 7 + $hourOffset;
                DB::table('sessions')->insert([
                    'name' => "{$activity[$dayOffset]} {$hour}:00-{$hour}:30",
                    'start_at_date' => MyDate::dayOfCurrentWeek($dayOffset)->toDateString(),
                    'start_at_time' => Carbon::now()->setTime($hour,0,0)->toTimeString(),
                    'end_at_time' => Carbon::now()->setTime($hour,30,0)->toTimeString(),
                    'capacity' => 10,
                ]);
            }
        }
        DB::table('sessions')->insert([
            'name' => "{$activity[1]} 07:00-08:00",
            'start_at_date' => MyDate::dayOfCurrentWeek(0)->toDateString(),
            'start_at_time' => Carbon::now()->setTime(7,0,0)->toTimeString(),
            'end_at_time' => Carbon::now()->setTime(8,0,0)->toTimeString(),
            'capacity' => 10,
        ]);
        DB::table('sessions')->insert([
            'name' => "{$activity[1]} 09:30-10:30",
            'start_at_date' => MyDate::dayOfCurrentWeek(0)->toDateString(),
            'start_at_time' => Carbon::now()->setTime(9,30,0)->toTimeString(),
            'end_at_time' => Carbon::now()->setTime(10,30,0)->toTimeString(),
            'capacity' => 10,
        ]);
        DB::table('sessions')->insert([
            'name' => "{$activity[1]} 16:30-17:30",
            'start_at_date' => MyDate::dayOfCurrentWeek(0)->toDateString(),
            'start_at_time' => Carbon::now()->setTime(16,30,0)->toTimeString(),
            'end_at_time' => Carbon::now()->setTime(17,30,0)->toTimeString(),
            'capacity' => 10,
        ]);
        DB::table('sessions')->insert([
            'name' => "{$activity[1]} 17:00-18:00",
            'start_at_date' => MyDate::dayOfCurrentWeek(0)->toDateString(),
            'start_at_time' => Carbon::now()->setTime(17,0,0)->toTimeString(),
            'end_at_time' => Carbon::now()->setTime(18,0,0)->toTimeString(),
            'capacity' => 10,
        ]);
        DB::table('sessions')->insert([
            'name' => "{$activity[1]} 17:30-18:30",
            'start_at_date' => MyDate::dayOfCurrentWeek(0)->toDateString(),
            'start_at_time' => Carbon::now()->setTime(17,30,0)->toTimeString(),
            'end_at_time' => Carbon::now()->setTime(18,30,0)->toTimeString(),
            'capacity' => 10,
        ]);
        DB::table('sessions')->insert([
            'name' => "{$activity[1]} 20:30-22:00",
            'start_at_date' => MyDate::dayOfCurrentWeek(0)->toDateString(),
            'start_at_time' => Carbon::now()->setTime(20,30,0)->toTimeString(),
            'end_at_time' => Carbon::now()->setTime(22,0,0)->toTimeString(),
            'capacity' => 10,
        ]);
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventService
{
    public static function checkEventDuplicationExceptOwn($event, $eventDate, $startTime, $endTime)
    {
        $event = DB::table('events')
            ->whereDate('start_date', $eventDate)
            ->whereTime('end_date', '>', $startTime)
            ->whereTime('start_date', '<', $endTime)
            ->get()
            ->toArray();

        if (count($event) > 1) {
            return true;
        } else {
            return false;
        }
    }


    public static function countEventDuplication($eventDate, $startTime, $endTime)
    {
        return DB::table('events')
         ->whereDate('start_date', $eventDate)
         ->whereTime('end_date', '>', $startTime)
         ->whereTime('start_date', '<', $endTime)
         ->count();
    }

    public static function joinDateAndTime($date, $time)
    {
        $join = $date ." " . $time;
        return Carbon::createFromFormat(
            'Y-m-d H:i', $join
        );
    }
}

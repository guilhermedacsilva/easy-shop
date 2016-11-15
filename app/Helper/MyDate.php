<?php

namespace EasyShop\Helper;

use Carbon\Carbon;

class MyDate {

    /* 0 is monday and 6 is sunday */
    public static function dayOfCurrentWeek($offset = 0) {
        return self::monday()->addDays($offset);
    }

    public static function monday() {
        return Carbon::today()->startOfWeek();
    }

    public static function sunday() {
        return Carbon::today()->endOfWeek();
    }

    public static function nextMonday() {
        return Carbon::today()->next(Carbon::MONDAY);
    }

}

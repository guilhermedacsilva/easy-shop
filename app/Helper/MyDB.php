<?php

namespace EasyShop\Helper;

use Carbon\Carbon;

class MyDB {

    /* Used to format date from forms
    $date = string or Carbon */
    public static function formatStartTimestamp($date)
    {
        if (is_string($date)) $date = Carbon::parse($date);
        $date->hour = 0;
        $date->minute = 0;
        $date->second = 0;
        return $date->toDateTimeString();
    }

    /* Used to format date from forms
    $date = string or Carbon */
    public static function formatEndTimestamp($date)
    {
        if (is_string($date)) $date = Carbon::parse($date);
        $date->hour = 23;
        $date->minute = 59;
        $date->second = 59;
        return $date->toDateTimeString();
    }

    /* keys: 'start_at', 'end_at'
    */
    public static function filterDateToQueryParams($dates)
    {
        $queryParams = [];
        if (isset($dates['start_at'])) $queryParams[] = self::formatStartTimestamp($dates['start_at']);
        if (isset($dates['end_at'])) $queryParams[] = self::formatEndTimestamp($dates['end_at']);
        return $queryParams;
    }

}

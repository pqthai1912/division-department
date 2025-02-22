<?php

namespace App\Utils;

use Carbon\Carbon;

class CarbonTimeUtil
{
    // get time now
    public static function getTimeNow()
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        return $dt->toDateString(); // yyyy-mm-dd
    }

}

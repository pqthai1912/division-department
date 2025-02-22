<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;

class CustomLogUtil
{
    /**
     * Write log information with a dynamic screen parameter.
     *
     * @param string $screen The name of the screen
     * @param string $level  Log level (optional, default is 'info')
     * @param string $message The log message (optional)
     * @return void
     */
    public static function writeLog($screen, $level = 'info', $message = 'Message')
    {
        // Prepare the log context
        $logContext = [
            'ip' => request()->ip(),
            'session_id' => session()->getId(),
            'user_id' => auth()->id() ?? 'guest',
            'screen' => $screen
        ];

        // Log the information using the given level and context
        Log::{$level}($message, $logContext);
    }

}

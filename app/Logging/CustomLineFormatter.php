<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\LogRecord;

class CustomLineFormatter extends LineFormatter
{
    public function __construct()
    {
        $format = "[%datetime%] %level_name% %extra.ip% %extra.screen_name% %extra.session_id% %extra.user_id%: %message%\n";
        $dateFormat = "Y-m-d H:i:s";
        
        parent::__construct($format, $dateFormat, true, true);
    }

    /**
     * override the default
     * 
     * @param LogRecord $record
    */
    public function format(LogRecord $record): string
    {
        $screen = $record['context']['screen'] ?? '';

        if (!isset($record->extra['ip'])) {
            $record->extra['ip'] = request()->ip() ?? '0.0.0.0';
        }
        if (!isset($record->extra['screen_name'])) {
            $record->extra['screen_name'] = $screen ? strtoupper($screen) : 'UNKNOWN_SCREEN';
        }
        if (!isset($record->extra['session_id'])) {
            $record->extra['session_id'] = session()->getId() ?? 'NO_SESSION';
        }
        if (!isset($record->extra['user_id'])) {
            $record->extra['user_id'] = auth()->id() ?? 0;
        }

        return parent::format($record);
    }
}
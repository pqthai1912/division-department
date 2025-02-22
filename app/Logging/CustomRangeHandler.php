<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class CustomRangeHandler extends AbstractProcessingHandler
{
    protected $minLevel;
    protected $maxLevel;
    protected $innerHandler;

    public function __construct($innerHandler, $minLevel = 'debug', $maxLevel = 'emergency', $bubble = true) {
        $this->innerHandler = $innerHandler;
        $this->minLevel = Logger::toMonologLevel($minLevel);
        $this->maxLevel = Logger::toMonologLevel($maxLevel);
        parent::__construct($this->minLevel, $bubble);
    }

    /**
     * override the default
     * 
     * @param LogRecord $record
    */
    protected function write(LogRecord $record): void {
        // compare minimum and maximum of level log
        if ($record->level?->value >= $this->minLevel->value && $record->level?->value <= $this->maxLevel->value) {
            $this->innerHandler->handle($record);
        }
    }
}
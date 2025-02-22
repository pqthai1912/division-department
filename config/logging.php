<?php

use App\Logging\CustomizeFormatter;
use App\Logging\CustomLineFormatter;
use App\Logging\CustomRangeHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Illuminate\Log\Logger as ILogger;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['stderr', 'stdout', 'application_log', 'error_log'],
            'ignore_exceptions' => false,
        ],
        
        'stdout' => [
            'driver' => 'custom',
            'via' => function () {
                $streamHandler = new StreamHandler(
                    env('APP_ENV') !== 'local'
                        ? 'php://stderr' // if being run by php artisan serve, docker,...
                        : storage_path('logs/cli-debug.log'), // if being run by wampp, xampp, laragon, virtual host,...
                    'debug',
                    false,
                    null,
                    true
                );
                
                $streamHandler->setFormatter(new CustomLineFormatter());
                $handler = new CustomRangeHandler(
                    $streamHandler,
                    'info', // min_level
                    'warning'  // max_level
                );

                return new Logger('stderr', [$handler]);
            },
        ],

        'stderr' => [
            'driver' => 'custom',
            'via' => function () {
                $streamHandler = new StreamHandler(
                    env('APP_ENV') !== 'local'
                        ? 'php://stderr'
                        : storage_path('logs/cli-error.log'),
                    'debug',
                    false,
                    null,
                    true
                );
                $streamHandler->setFormatter(new CustomLineFormatter());

                $handler = new CustomRangeHandler(
                    $streamHandler,
                    'error', // min_level
                    'emergency' // max_level
                );

                return new Logger('stderr', [$handler]);
            },
        ],

        'application_log' => [
            'driver' => 'custom',
            'via' => function () {
                $rotatingHandler = new RotatingFileHandler(
                    storage_path('logs/application.log'), // log file path
                    14,  // max files to keep
                    'debug', // logging level
                    true, // create if not exists
                    null, // file permission (optional)
                    true  // use lock file (optional)
                );

                $rotatingHandler->setFormatter(new CustomLineFormatter());

                $handler = new CustomRangeHandler(
                    $rotatingHandler,
                    'info', // min_level
                    'warning', // max_level
                );

                return new Logger('application_log', [$handler]);
            },
        ],

        'error_log' => [
            'driver' => 'custom',
            'via' => function () {
                $rotatingHandler = new RotatingFileHandler(
                    storage_path('logs/error.log'), // log file path
                    14,  // max files to keep
                    'debug', // logging level
                    true, // create if not exists
                    null, // file permission (optional)
                    true  // use lock file (optional)
                );

                $rotatingHandler->setFormatter(new CustomLineFormatter());

                $handler = new CustomRangeHandler(
                    $rotatingHandler,
                    'error', // min_level
                    'emergency', // max_level
                );

                return new Logger('error_log', [$handler]);
            },
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],
    ],
];

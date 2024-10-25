<?php

namespace LaunchpadLogger;

use Monolog\Formatter\HtmlFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Registry;

class MonologHandler implements HandlerInterface
{
    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    public function __construct(string $logger_name, string $log_file_name, string $log_path = '', int $log_debug_interval = 0)
    {
        $log_level = \Monolog\Logger::DEBUG;

        if ( Registry::hasLogger( $logger_name ) ) {
            $this->logger = Registry::$logger_name();
        }

        /**
         * File handler.
         * HTML formatter is used.
         */
        $handler   = new StreamHandler( $this->get_log_path($log_file_name, $log_path, $log_debug_interval), $log_level );
        $formatter = new HtmlFormatter();

        $handler->setFormatter( $formatter );

        /**
         * Thanks to the processors, add data to each log:
         * - `debug_backtrace()` (exclude this class and Abstract_Buffer).
         */
        $trace_processor = new IntrospectionProcessor( $log_level, [ get_called_class(), 'Abstract_Buffer' ] );

        // Create the logger.
        $this->logger = new \Monolog\Logger( $logger_name, [ $handler ], [ $trace_processor ] );

        // Store the logger.
        Registry::addLogger( $this->logger );

    }

    protected function get_log_path(string $log_file_name, string $log_path = '', int $log_debug_interval = 0) {
        if ( $log_path !== '' ) {
            // Make sure the file uses a ".log" extension.
            return preg_replace( '/\.[^.]*$/', '', $log_path ) . '.log';
        }

        if ( $log_debug_interval ) {
            // Adds an optional logs rotator depending on a constant value - WP_ROCKET_DEBUG_INTERVAL (interval by minutes).
            $rotator = str_pad( round( ( strtotime( 'now' ) - strtotime( 'today midnight' ) ) / 60 / $log_debug_interval ), 4, '0', STR_PAD_LEFT );
            return WP_CONTENT_DIR . '/logs/' . $rotator . '-' . $log_file_name;
        } else {
            return WP_CONTENT_DIR . '/logs/' . $log_file_name;
        }
    }

    public function debug($message, array $context = [])
    {
        $this->logger->debug($message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->logger->info($message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->logger->notice($message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->logger->warning($message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->logger->error($message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->logger->critical($message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->logger->alert($message, $context);
    }

    public function emergency($message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }
}

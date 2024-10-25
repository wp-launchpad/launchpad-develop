<?php
namespace LaunchpadLogger;

class Logger implements LoggerInterface
{
    /**
     * @var HandlerInterface[]
     */
    protected $handlers = [];

    protected $is_enabled = false;

    /**
     * @param HandlerInterface[] $handlers
     */
    public function __construct( array $handlers, bool $log_enabled ) {
        $this->handlers = $handlers;
        $this->is_enabled = $log_enabled;
    }

    public function debug( $message, array $context = [] ) {
        if(! $this->is_enabled) {
            return;
        }
        foreach ($this->handlers as $handler) {
            $handler->debug($message, $context);
        }
    }

    public function info( $message, array $context = [] ) {
        if(! $this->is_enabled) {
            return;
        }
        foreach ($this->handlers as $handler) {
            $handler->info($message, $context);
        }
    }

    public function notice( $message, array $context = [] ) {
        if(! $this->is_enabled) {
            return;
        }
        foreach ($this->handlers as $handler) {
            $handler->notice($message, $context);
        }
    }

    public function warning( $message, array $context = [] ) {
        if(! $this->is_enabled) {
            return;
        }
        foreach ($this->handlers as $handler) {
            $handler->warning($message, $context);
        }
    }

    public function error( $message, array $context = [] ) {
        if(! $this->is_enabled) {
            return;
        }
        foreach ($this->handlers as $handler) {
            $handler->error($message, $context);
        }
    }

    public function critical( $message, array $context = [] ) {
        if(! $this->is_enabled) {
            return;
        }
        foreach ($this->handlers as $handler) {
            $handler->critical($message, $context);
        }
    }

    public function alert( $message, array $context = [] ) {
        if(! $this->is_enabled) {
            return;
        }
        foreach ($this->handlers as $handler) {
            $handler->alert($message, $context);
        }
    }

    public function emergency( $message, array $context = [] ) {
        if(! $this->is_enabled) {
            return;
        }
        foreach ($this->handlers as $handler) {
            $handler->emergency($message, $context);
        }
    }

    public function debug_enabled() {
        return $this->is_enabled;
    }

    public function enable_debug() {
        $this->is_enabled = true;
    }

    public function disable_debug() {
        $this->is_enabled = false;
    }
}

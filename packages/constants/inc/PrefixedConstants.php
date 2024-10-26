<?php

namespace LaunchpadConstants;

use LaunchpadDispatcher\Dispatcher;

class PrefixedConstants extends Constants implements PrefixedConstantsInterface
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * @param string $prefix
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher, string $prefix)
    {
        parent::__construct($dispatcher);
        $this->prefix = $prefix;
    }

    public function has(string $name): bool
    {
        return parent::has($this->prefix . $name);
    }

    public function get(string $name)
    {
        return parent::get($this->prefix . $name);
    }

    public function set(string $name, $value)
    {
        parent::set($this->prefix . $name, $value);
    }
}
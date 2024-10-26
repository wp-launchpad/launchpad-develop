<?php

namespace LaunchpadTakeOff\ObjectValues;

abstract class ObjectValue
{
    protected $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->set_value($value);
    }

    /**
     * @param mixed $value
     */
    public function set_value($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function get_value()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return void
     *
     * @throws InvalidValue
     */
    abstract protected function validate($value): void;

}
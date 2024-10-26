<?php

namespace LaunchpadBerlinDB\Entities;

class Name
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->set_value($value);
    }


    /**
     * @return string
     */
    public function get_value(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function set_value(string $value): void
    {
        if(! preg_match('/[A-z_][A-z0-9_]*/', $value)) {
            throw new InvalidValue('Invalid name');
        }
        $this->value = $value;
    }

}

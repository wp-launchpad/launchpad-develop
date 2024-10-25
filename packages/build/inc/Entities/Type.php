<?php

namespace LaunchpadBuild\Entities;

class Type
{
    const FIXED = 'fixed';
    const FIXED_SHORT = 'f';
    const MAJOR = 'major';
    const MAJOR_SHORT = 'M';
    const MINOR = 'minor';
    const MINOR_SHORT = 'm';
    const PATCH = 'patch';
    const PATCH_SHORT = 'p';
    const VALUES = [
        self::FIXED,
        self::FIXED_SHORT,
        self::MAJOR,
        self::MAJOR_SHORT,
        self::MINOR,
        self::MINOR_SHORT,
        self::PATCH,
        self::PATCH_SHORT,
    ];

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
    public function set_value(string $value)
    {
        if (! in_array($value, self::VALUES, true)) {
            throw new InvalidValue('Type is invalid');
        }

        $this->value = $value;
    }



}

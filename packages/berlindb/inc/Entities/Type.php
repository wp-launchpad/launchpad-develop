<?php

namespace LaunchpadBerlinDB\Entities;

class Type
{

    const STRING = 'string';

    const TEXT = 'text';

    const INT = 'int';

    const FLOAT = 'float';

    const BOOLEAN = 'boolean';

    const DATETIME = 'datetime';

    const VALUES = [
        self::STRING,
        self::TEXT,
        self::INT,
        self::FLOAT,
        self::BOOLEAN,
        self::DATETIME,
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
    public function set_value(string $value): void
    {
        if(! in_array($value, self::VALUES)) {
            throw new InvalidValue('The type is invalid.');
        }
        $this->value = $value;
    }

}

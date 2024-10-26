<?php

namespace LaunchpadBerlinDB\Entities;

class FileType
{

    const TABLE = 'TABLE';
    const ROW = 'ROW';

    const ROW_PROPERTIES = 'ROW_PROPERTIES';

    const SCHEMA = 'SCHEMA';

    const VALUES = [
        self::TABLE,
        self::ROW,
        self::ROW_PROPERTIES,
        self::SCHEMA,
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

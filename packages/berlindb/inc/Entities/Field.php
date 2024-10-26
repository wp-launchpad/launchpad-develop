<?php

namespace LaunchpadBerlinDB\Entities;

class Field
{
    /**
     * @var Type
     */
    protected $type;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var bool
     */
    protected $nullable;

    /**
     * @param Type $type
     * @param Name $name
     * @param bool $nullable
     */
    public function __construct(Type $type, Name $name, bool $nullable = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->nullable = $nullable;
    }

    /**
     * @return string
     */
    public function get_type(): string
    {
        return $this->type->get_value();
    }

    /**
     * @return string
     */
    public function get_name(): string
    {
        return $this->name->get_value();
    }

    /**
     * @return bool
     */
    public function is_nullable(): bool
    {
        return $this->nullable;
    }


}

<?php

namespace LaunchpadBuild\Entities;

class Version
{
    /**
     * @var string
     */
    protected $value = '1.0.0';

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->set_value($value);
    }

    public function get_value(): string {
        return $this->value;
    }

    public function set_value(string $value) {
        if(! preg_match('/^(\d+\.)?(\d+\.)?(\*|\d+)$/', $value)) {
            throw new InvalidValue('Invalid version');
        }
        $this->value = $value;
    }
    public function increase(Type $type = null) {
        $type = ! is_null($type) ? $type->get_value(): Type::PATCH;
        if($type === Type::FIXED || $type === Type::FIXED_SHORT) {
            return;
        }

        $parts = explode(".", $this->value);
        if($type === Type::PATCH || $type === Type::PATCH_SHORT) {
            $part = array_pop($parts);
            $part ++;
            $parts []= $part;
        }

        if($type === Type::MINOR || $type === Type::MINOR_SHORT) {
            $first_part = array_shift($parts);
            $part = array_shift($parts);
            $part ++;
            array_unshift($parts, $part);
            array_unshift($parts, $first_part);
        }

        if($type === Type::MAJOR || $type === Type::MAJOR_SHORT) {
            $part = array_shift($parts);
            $part ++;
            array_unshift($parts, $part);
        }

        $this->value = implode( ".", $parts );
    }
}

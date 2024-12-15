<?php

namespace LaunchpadFrontTakeOff\ObjectValues;

use LaunchpadCLI\ObjectValues\InvalidValue;

class FrontVersion
{
    const REACT = 'react';
    const VUE = 'vue';

    const VANILLA = 'vanilla';

    const VALUES = [self::REACT, self::VUE, self::VANILLA];

    /**
     * Value validated by the object value.
     *
     * @var string
     */
    protected $value;

    /**
     * Instantiate the class.
     *
     * @param string $value value validated by the object value.
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Validate the value.
     *
     * @param string $value Value to validate.
     *
     * @return void
     * @throws InvalidValue
     */
    protected function validate(string $value) {
        if(! in_array($value, self::VALUES, true)) {
            throw new InvalidValue();
        }
    }
}

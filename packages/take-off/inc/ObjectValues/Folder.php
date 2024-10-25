<?php

namespace LaunchpadTakeOff\ObjectValues;

class Folder extends ObjectValue
{

    protected function validate($value): void
    {
        if( ! preg_match('/^(\/?[A-Z.\-_a-z0-9]+)+\/?$/', $value)) {
            throw new InvalidValue('The value is not a valid path');
        }
    }
}

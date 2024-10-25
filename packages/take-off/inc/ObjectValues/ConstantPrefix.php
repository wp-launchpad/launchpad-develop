<?php

namespace LaunchpadTakeOff\ObjectValues;

class ConstantPrefix extends ObjectValue
{

    protected function validate($value): void
    {
        if(! preg_match('/^[A-Z]+(_[A-Z]+)*_$/', $value) ) {
            throw new InvalidValue('The value is not constant prefix');
        }
    }
}

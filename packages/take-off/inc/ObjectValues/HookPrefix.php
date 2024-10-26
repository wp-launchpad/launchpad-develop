<?php

namespace LaunchpadTakeOff\ObjectValues;

class HookPrefix extends ObjectValue
{

    protected function validate($value): void
    {
        if(! preg_match('/^[a-z]+(_[a-z]+)*_$/', $value) ) {
            throw new InvalidValue('The value is not hook prefix');
        }
    }
}
